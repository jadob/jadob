<?php


namespace Jadob\EventSourcing\EventStore;


use DateTimeImmutable;

class DateTimeFactory
{
    public static function createFromMilliseconds(int $milliseconds): \DateTimeInterface
    {
        /**
         * @TODO: this looks ugly, consider refactoring
         */
        $seconds = (int)(substr((string)$milliseconds, 0, -3));

        return DateTimeImmutable::createFromFormat('U', $seconds)
            ->modify(
                sprintf('+%sms', (int)substr((string)$milliseconds, -3))
            );
    }

}