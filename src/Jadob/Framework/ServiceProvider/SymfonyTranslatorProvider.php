<?php
declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Bridge\Symfony\Translation\TranslationSource;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use Jadob\Framework\Logger\LoggerFactory;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Translation\Formatter\MessageFormatter;
use Symfony\Component\Translation\Formatter\MessageFormatterInterface;
use Symfony\Component\Translation\Loader\PhpFileLoader;
use Symfony\Component\Translation\LoggingTranslator;
use Symfony\Component\Translation\Translator;
use Symfony\Contracts\Translation\TranslatorInterface;
use function glob;
use function preg_match;
use function sprintf;

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
    public function getConfigNode(): ?string
    {
        return 'translator';
    }

    /**
     * @param string[]|array[] $config
     * @psalm-param array{locale:string, logging:bool} $config
     *
     * @return array<string, callable|object>
     */
    public function register(ContainerInterface $container, null|object|array $config = null): array
    {
        return [
            //expose this as a separate service to make it possible to override
            MessageFormatterInterface::class => static fn(): MessageFormatterInterface => new MessageFormatter(),

            TranslatorInterface::class => static function (
                ContainerInterface $container,
                LoggerFactory $loggerFactory
            ) use ($config): TranslatorInterface {
                /** @var BootstrapInterface $bootstrap */
                $bootstrap = $container->get(BootstrapInterface::class);
                /** @var TranslationSource[] $sources */
                $sources = [];

                $symfonyTranslator = new Translator(
                    $config['locale'],
                    $container->get(MessageFormatterInterface::class)
                );
                $symfonyTranslator->addLoader('php', new PhpFileLoader());


                /**
                 * Adding translations automatically:
                 *
                 * Traverse CONFIG_DIR/translations/ * / *.php files for translations
                 * When found any, a filename without extension will be used as a domain
                 */
                $sourcesPath = $bootstrap->getConfigDir() . '/translations/*/*.php';
                $sourcesGlob = glob($sourcesPath);

                $sourcesRegexp = sprintf(
                    '@%s\/translations\/(?<locale>[A-Za-z]{2})\/(?<domain>[_a-zA-Z]*).php@i',
                    $bootstrap->getConfigDir()
                );

                foreach ($sourcesGlob as $sourcePath) {
                    preg_match($sourcesRegexp, $sourcePath, $sourceMatch);
                    $sources[] = new TranslationSource($sourcePath, $sourceMatch['locale'], $sourceMatch['domain']);
                }

                /**
                 * User-defined translations
                 */
                if (isset($config['sources'])) {
                    foreach ($config['sources'] as $userDefinedSource) {
                        $sources[] = new TranslationSource(
                            $userDefinedSource['path'],
                            $userDefinedSource['locale'],
                            $userDefinedSource['domain']
                        );
                    }
                }

                foreach ($sources as $source) {
                    $symfonyTranslator->addResource(
                        'php',
                        $source->getPath(),
                        $source->getLocale(),
                        $source->getDomain()
                    );
                }

                /**
                 * @TODO: make a separate logger for translator
                 */
                if (isset($config['logging']) && $config['logging'] === true) {
                    return new LoggingTranslator(
                        $symfonyTranslator,
                        $loggerFactory->getDefaultLogger()
                    );
                }

                return $symfonyTranslator;
            }
        ];
    }
}