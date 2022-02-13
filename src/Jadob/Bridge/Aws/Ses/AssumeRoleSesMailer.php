<?php
declare(strict_types=1);

namespace Jadob\Bridge\Aws\Ses;

use Aws\Sdk;
use Symfony\Component\Mime\Email;

/**
 * When you need to send emails using another account.
 * Uses AssumeRole, so it is required to cross-account both of your accounts.
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class AssumeRoleSesMailer extends SesMailer
{
    protected Sdk $sdk;
    protected string $roleToAssumeArn;
    protected ?array $assumedCredentials = null;

    /**
     * @param Sdk $sdk
     * @param string $roleToAssumeArn
     * @param array $config
     * @psalm-param array{source_arn: string, from_arm: string, return_path_arn: string} $config
     * @noinspection PhpMissingParentConstructorInspection
     */
    public function __construct(Sdk $sdk, string $roleToAssumeArn, array $config = [])
    {
        $this->sdk = $sdk;
        $this->roleToAssumeArn = $roleToAssumeArn;
        $this->config = $config;
    }

    public function send(Email $email): void
    {
        if ($this->assumedCredentials === null) {
            $stsClient = $this->sdk->createSts();

            $assumedCredentials = $stsClient->assumeRole([
                'RoleArn' => $this->roleToAssumeArn,
                'RoleSessionName' => 'JadobAssumeRole' . md5(base64_encode(random_bytes(10))),
            ])->toArray();

            $this->assumedCredentials = $assumedCredentials;

            $assumedSdk = $this->sdk->copy(
                [
                    'credentials' => [
                        'key' => $assumedCredentials['Credentials']['AccessKeyId'],
                        'secret' => $assumedCredentials['Credentials']['SecretAccessKey'],
                        'token' => $assumedCredentials['Credentials']['SessionToken']
                    ]
                ]
            );
            $this->sesClient = $assumedSdk->createSes();
        }


        parent::send($email);
    }
}