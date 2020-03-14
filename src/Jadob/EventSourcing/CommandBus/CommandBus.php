<?php

declare(strict_types=1);

namespace Jadob\EventSourcing\CommandBus;

use Psr\Log\LoggerInterface;
use Throwable;

/**
 * @author takbardzoimiki <mikolajczajkowsky@gmail.com>
 * @license proprietary
 */
class CommandBus
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var array<string,callable>
     */
    protected $routing = [];

    /**
     * CommandBus constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    // TODO better use object type for $handler here
    public function addRoute(string $commandFqcn, callable $handler): self
    {
        if (isset($this->routing[$commandFqcn])) {
            throw new \RuntimeException('Handler for class ' . $commandFqcn . ' is already registered.');
        }

        $this->routing[$commandFqcn] = $handler;
        return $this;
    }

    /**
     * TODO: allow for returning values and document it properly
     * @param object $command
     * @throws Throwable
     */
    public function handle(object $command)
    {
        $commandFqcn = \get_class($command);
        $this->logger->info('Command ' . $commandFqcn . ' received');

        try {
            if (!isset($this->routing[$commandFqcn])) {
                throw new \RuntimeException('There is no handler for ' . $commandFqcn . ' command.');
            }

            $result = null;
            $handler = $this->routing[$commandFqcn];
            $dispatchingMethodUsed = '';
            //Objects implementing __invoke can be used as callables (since PHP 5.3)
            //@see https://www.php.net/manual/en/language.types.callable.php Example #1
            if ($this->isHandlerInvokableClass($handler)) {
                $dispatchingMethodUsed = 'invokable';
                $this->logger->info('Calling __invoke() method from ' . get_class($handler) . '.');
                $result = $handler($command);
            }

            if ($handler instanceof \Closure) {
                $dispatchingMethodUsed = 'closure';
                $this->logger->info('Handler for event ' . $commandFqcn . ' is Closure and it has been called.');
                $result = $handler($command);
            }

            $this->logger->info('Command ' . $commandFqcn . ' has been dispatched via ' . $dispatchingMethodUsed);
            return $result;

        } catch (Throwable $e) {
            $this->logger->critical('An error occured during command handling: ' . $e->getMessage(), $e->getTrace());
            throw $e;
        }

    }

    protected function isHandlerInvokableClass(callable $object): bool
    {
        return \is_object($object) && \method_exists($object, '__invoke');
    }
}