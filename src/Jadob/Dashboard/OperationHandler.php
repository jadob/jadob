<?php
declare(strict_types=1);

namespace Jadob\Dashboard;

use Closure;
use Jadob\Contracts\Dashboard\DashboardContextInterface;
use Jadob\Dashboard\Configuration\EntityOperation;
use Jadob\Dashboard\Exception\DashboardException;
use Jadob\Dashboard\ObjectManager\DoctrineOrmObjectManager;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class OperationHandler
{
    public function __construct(protected ContainerInterface $container, protected LoggerInterface $logger, protected DoctrineOrmObjectManager $doctrineOrmObjectManager)
    {
    }


    public function processOperation(EntityOperation $operation, object $object, DashboardContextInterface $context): void
    {
        try {
            $argumentTransformer = $operation->getArgumentTransformer();
            $arguments = [$object];

            if ($argumentTransformer instanceof Closure) {
                $this->logger->debug('There is an argument transformer attached.');
                $arguments = $argumentTransformer($object, $context);
                if (!is_array($arguments)) {
                    throw new DashboardException('Argument transformer should return an array.');
                }
            }

            $handlerFqcn = $operation->getHandlerFqcn();
            $handlerMethod = $operation->getHandlerMethod();

            if ($handlerFqcn === null) {
                $this->logger->debug(sprintf('There is no handler FQCN, so i am calling %s straight on object.', $handlerMethod));
                $object->$handlerMethod(...$arguments);
            } else {
                $methodToCall = $handlerMethod;
                if ($handlerMethod === null) {
                    $methodToCall = '__invoke';
                    $this->logger->debug('There is handler FQCN but no method, using "__invoke" then.');
                }

                $this->logger->debug(sprintf('I am calling %s#%s', $handlerFqcn, $methodToCall));
                /** @var object $handlerClass */
                $handlerClass = $this->container->get($handlerFqcn);
                $handlerClass->$methodToCall(...$arguments);
            }

            if ($operation->isForcePersist()) {
                $this->logger->debug('Storing object in persistence.');
                $this->doctrineOrmObjectManager->persist($object);
            }

            $this->logger->debug('Operation handled.');
        } catch (Throwable $e) {
            $this->logger->critical(sprintf('Caught an exception during processing: %s', $e->getMessage()), $e->getTrace());
            throw $e;
        }
    }
}