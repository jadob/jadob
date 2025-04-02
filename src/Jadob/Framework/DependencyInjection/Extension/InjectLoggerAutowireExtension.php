<?php

declare(strict_types=1);

namespace Jadob\Framework\DependencyInjection\Extension;

use Jadob\Contracts\DependencyInjection\ContainerAutowiringExtensionInterface;
use Jadob\Framework\Logger\LoggerFactory;
use Psr\Log\LoggerInterface;

class InjectLoggerAutowireExtension implements ContainerAutowiringExtensionInterface
{

    public function __construct(
        private LoggerFactory $loggerFactory,
    )
    {
    }

    public function supportsConstructorInjectionFor(string $class, string $argumentName, string $argumentType, array $argumentAttributes): bool
    {
        return $argumentType === LoggerInterface::class && (
                $argumentName === 'logger'
                || str_ends_with($argumentName, 'Logger')
            );
    }

    public function injectConstructorArgument(string $class, string $argumentName, string $argumentType, array $argumentAttributes): object
    {
        if ($argumentName === 'logger') {
            return $this->loggerFactory->getDefaultLogger();
        }

        $channel = substr($argumentName, 0, strlen($argumentName) - strlen('Logger'));
        return $this->loggerFactory->getLoggerForChannel($channel);
    }
}