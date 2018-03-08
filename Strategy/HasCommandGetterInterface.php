<?php

namespace Jadob\CommandBus\Strategy;

/**
 * Interface HasCommandGetterInterface
 * @package Jadob\CommandBus\Strategy
 */
interface HasCommandGetterInterface
{
    /**
     * Returns FQCN of command class.
     * @return string
     */
    public function getCommandClassName(): string;
}