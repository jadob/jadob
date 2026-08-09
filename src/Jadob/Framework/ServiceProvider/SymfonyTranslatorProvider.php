<?php

declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Bridge\Symfony\Translation\TranslationSource;
use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\Attribute\InjectParameter;
use Jadob\Contracts\DependencyInjection\Attribute\InjectService;
use Jadob\Contracts\DependencyInjection\ConfigObjectProviderInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\Reference;
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
use Symfony\Component\Translation\MessageCatalogueInterface;
use Symfony\Component\Translation\Translator;
use Symfony\Contracts\Translation\TranslatorInterface;
use function glob;
use function preg_match;
use function sprintf;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
final readonly class SymfonyTranslatorProvider implements ServiceProviderInterface, ConfigObjectProviderInterface
{

    public function getConfigNode(): string
    {
        return 'translator';
    }

    /**
     * @param ContainerBuilderInterface $builder
     * @param TranslatorConfig|null $config
     * @return void
     */
    public function register(
        ContainerBuilderInterface $builder,
        ?ConfigNodeInterface      $config = null
    ): void
    {
        $builder->requireParameter('translations_directory');
        $builder->addFallbackParameter(
            'translations_directory',
            '${config_dir}/translations'
        );

        $builder->set(MessageFormatter::class);

        $builder->bind(
            MessageFormatterInterface::class,
            MessageFormatter::class);

        $builder
            ->set(Translator::class)
            ->withFactory(
                static function (
                    #[InjectParameter('translations_directory')] string $translationsDirectory,
                    MessageFormatterInterface                           $messageFormatter,
                ) use ($config): TranslatorInterface {
                    /** @var TranslationSource[] $sources */
                    $sources = [];

                    $symfonyTranslator = new Translator(
                        $config->locale,
                        $messageFormatter,
                    );
                    $symfonyTranslator->addLoader('php', new PhpFileLoader());

                    /**
                     * Adding translations automatically:
                     *
                     * Traverse CONFIG_DIR/translations/ * / *.php files for translations
                     * When found any, a filename without extension will be used as a domain
                     */
                    $sourcesPath = sprintf('%s/*/*.php', $translationsDirectory);
                    $sourcesGlob = glob($sourcesPath);

                    $sourcesRegexp = sprintf(
                        '@%s\/(?<locale>[A-Za-z]{2})\/(?<domain>[_a-zA-Z]*).php@i',
                        $translationsDirectory
                    );

                    foreach ($sourcesGlob as $sourcePath) {
                        preg_match($sourcesRegexp, $sourcePath, $sourceMatch);
                        $sources[] = new TranslationSource(
                            $sourcePath,
                            $sourceMatch['locale'],
                            $sourceMatch['domain']
                        );
                    }

                    foreach ($sources as $source) {
                        $symfonyTranslator->addResource(
                            'php',
                            $source->path,
                            $source->locale,
                            $source->domain
                        );
                    }

                    return $symfonyTranslator;
                }
            );


        $builder->bind(
            TranslatorInterface::class,
            Translator::class
        );

        if ($config->loggingEnabled) {
            $builder
                ->set('translator.logger', LoggerInterface::class)
                ->withFactory(function (LoggerFactory $factory) {
                    return $factory->getLoggerForChannel('translator');
                });

            $builder
                ->set(LoggingTranslator::class)
                ->withArgument(
                    'translator',
                    Reference::service(Translator::class)
                )
                ->withArgument(
                    'logger',
                    Reference::service('translator.logger')
                );

            $builder->bind(
                TranslatorInterface::class,
                LoggingTranslator::class);
        }
    }

    public function getDefaultConfigurationObject(): ConfigNodeInterface
    {
        return new TranslatorConfig();
    }
}