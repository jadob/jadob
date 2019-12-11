<?php

namespace Jadob\Security\Auth\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class GeneratePasswordHashCommand
 *
 * @package Jadob\Security\Auth\Command
 * @author  pizzaminded <miki@appvende.net>
 * @license MIT
 */
class GeneratePasswordHashCommand extends Command
{

    /**
     * @var string
     */
    protected static $defaultName = 'security:auth:password-hash';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // ...
    }
}