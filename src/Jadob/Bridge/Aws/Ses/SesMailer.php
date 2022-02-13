<?php
declare(strict_types=1);

namespace Jadob\Bridge\Aws\Ses;

use Aws\Ses\SesClient;
use Symfony\Component\Mime\Email;

/**
 * Sends email using AWS SDK.
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class SesMailer
{
    protected SesClient $sesClient;

    /**
     * @var array{source_arn: string, from_arn: string, return_path_arn: string}
     */
    protected array $config;

    /**
     * SesMailer constructor.
     * @param SesClient $sesClient
     * @param array{source_arn: string, from_arm: string, return_path_arn: string} $config
     */
    public function __construct(SesClient $sesClient, array $config = [])
    {
        $this->sesClient = $sesClient;
        $this->config = $config;
    }

    /**
     * @param Email $email
     */
    public function send(Email $email): void
    {
        $charset = 'UTF-8';
        $plainToEmails = [];
        foreach ($email->getTo() as $address) {
            $plainToEmails[] = $address->toString();
        }

        $plainReplyToEmails = [];
        foreach ($email->getReplyTo() as $address) {
            $plainReplyToEmails[] = $address->toString();
        }

        $from = $email->getFrom();
        $plainFromAddress = reset($from)->toString();

        $command = [
            'Destination' => [
                'ToAddresses' => $plainToEmails,
            ],
            'ReplyToAddresses' => $plainReplyToEmails,
            'Source' => $plainFromAddress,
            'Message' => [
                'Body' => [
                    'Html' => [
                        'Charset' => $email->getHtmlCharset(),
                        'Data' => $email->getHtmlBody(),
                    ],
                    'Text' => [
                        'Charset' => $email->getTextCharset(),
                        'Data' => $email->getTextBody(),
                    ],
                ],
                'Subject' => [
                    'Charset' => $charset,
                    'Data' => $email->getSubject(),
                ],
            ]
        ];

        /**
         * Enables support for cross-account mailing
         * (Use case: your app is deployed on ACCOUNT1, but you have to send emails from ACCOUNT2)
         * @see https://docs.aws.amazon.com/ses/latest/DeveloperGuide/sending-authorization-delegate-sender-tasks-email.html
         */
        if (isset($this->config['source_arn'])) {
            $command['SourceArn'] = $this->config['source_arn'];
        }
        if (isset($this->config['from_arn'])) {
            $command['FromArn'] = $this->config['from_arn'];
        }
        if (isset($this->config['return_path_arn'])) {
            $command['ReturnPathArn'] = $this->config['return_path_arn'];
        }

        $this->sesClient->sendEmail($command);
    }
}