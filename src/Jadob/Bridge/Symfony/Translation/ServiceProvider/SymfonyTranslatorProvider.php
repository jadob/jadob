<?php
declare(strict_types=1);

namespace Jadob\Bridge\Symfony\Translation\ServiceProvider;


use Jadob\Bridge\Symfony\Translation\Translator;
use Jadob\Container\Container;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Contract\Translation\TranslatorInterface;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Translation\Formatter\MessageFormatter;
use Symfony\Component\Translation\LoggingTranslator;
use Symfony\Component\Translation\Translator as SymfonyTranslator;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class SymfonyTranslatorProvider implements ServiceProviderInterface
{

    /**
     * returns Config node name that will be passed as $config in register() method.
     * return null if no config needed.
     *
     * @return string|null
     */
    public function getConfigNode()
    {
        return 'translation';
    }

    /**
     * @param string[]|array[] $config
     * @psalm-param array{locale:string, logging:bool} $config
     *
     * @return array<string, callable|object>
     */
    public function register($config)
    {
        return [
            //expose this as a separate service to make it possible to override
            MessageFormatter::class => static function () {
                return new MessageFormatter();
            },
            TranslatorInterface::class => static function (ContainerInterface $container) use ($config) {
                $symfonyTranslator = new SymfonyTranslator(
                    $config['locale'],
                    $container->get(MessageFormatter::class)
                );

                if (isset($config['logging']) && $config['logging'] === true) {
                    $symfonyTranslator = new LoggingTranslator(
                        $symfonyTranslator,
                        $container->get(LoggerInterface::class)
                    );
                }

                return new Translator($symfonyTranslator);
            }
        ];
    }

    /**
     * Stuff that's needed to be done after container is built.
     * What can you do using these method?
     * - This one gets container as a first argument, so, you can e.g. get all services implementing SomeCoolInterface,
     * and inject them somewhere
     * (example 1: using Twig, you can register all extensions)
     * (example 2: EventDispatcher registers all Listeners here)
     * - You can add new services of course
     *
     * @param Container $container
     * @param array|null $config the same config node as passed in register()
     * @return void
     * @throws ServiceNotFoundException
     */
    public function onContainerBuild(Container $container, $config)
    {
        // TODO: Implement onContainerBuild() method.
    }
}