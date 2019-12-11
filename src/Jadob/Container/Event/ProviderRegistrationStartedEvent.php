<?php
/**
 * Created by pizzaminded <miki@appvende.net>
 * User: mikolajczajkowsky
 * Date: 11.12.2019
 * Time: 02:27
 */

namespace Jadob\Container\Event;


class ProviderRegistrationStartedEvent implements BuilderRelatedEventInterface
{

    public $providerClass;
    public function __construct(string $providerClass)
    {
        $this->providerClass = $providerClass;
    }

    public function getPayload()
    {
        return $this->providerClass;
    }
}