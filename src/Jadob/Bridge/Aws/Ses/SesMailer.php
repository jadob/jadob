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
     * SesMailer constructor.
     * @param SesClient $sesClient
     */
    public function __construct(SesClient $sesClient)
    {
        $this->sesClient = $sesClient;
    }

    /**
     * @param Email $email
     */
    public function send(Email $email)
    {
        $charset = 'UTF-8';
        $plainToEmails = [];
        foreach ($email->getTo() as $address) {
            $plainToEmails[] = $address->toString();
        }
        unset($address);

        $plainReplyToEmails = [];
        foreach ($email->getReplyTo() as $address) {
            $plainReplyToEmails[] = $address->toString();
        }
        unset($address);

        $from = $email->getFrom();
        $plainFromAddress = reset($from)->toString();

        $result = $this->sesClient->sendEmail([
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
        ]);


    }
}