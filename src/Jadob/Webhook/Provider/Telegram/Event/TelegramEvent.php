<?php
declare(strict_types=1);

namespace Jadob\Webhook\Provider\Telegram\Event;

use Jadob\Typed\Telegram\Update;

class TelegramEvent
{

    public function __construct(
        protected Update $update
    )
    {
    }

    /**
     * @return Update
     */
    public function getUpdate(): Update
    {
        return $this->update;
    }



}