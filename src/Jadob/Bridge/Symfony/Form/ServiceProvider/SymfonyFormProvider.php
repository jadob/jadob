<?php

declare(strict_types=1);

namespace Jadob\Bridge\Symfony\Form\ServiceProvider;

use Closure;
use Exception;
use Jadob\Bridge\Symfony\Validator\ServiceProvider\SymfonyValidatorProvider;
use Jadob\Bridge\Twig\ServiceProvider\TwigProvider;
use Jadob\Container\Builder\ContainerBuilder;
use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Container\Container;
use Jadob\Contracts\DependencyInjection\Attribute\InjectTaggedServices;
use Jadob\Contracts\DependencyInjection\ConfigObjectProviderInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\Reference;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Framework\ServiceProvider\SymfonyTranslatorProvider;
use LogicException;
use Psr\Container\ContainerInterface;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormExtensionInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormRenderer;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Twig\Environment;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
final readonly class SymfonyFormProvider implements ServiceProviderInterface, ParentServiceProviderInterface, ConfigObjectProviderInterface
{

    public function getConfigNode(): string
    {
        return 'forms';
    }

    /**
     * @param ContainerBuilderInterface $builder
     * @param FormsConfig|null $config
     * @return void
     */
    public function register(ContainerBuilderInterface $builder, ?ConfigNodeInterface $config = null): void
    {
        if (!($config instanceof FormsConfig)) {
            throw new LogicException(
                sprintf('%s requires a forms config object', __CLASS__)
            );
        }

        $builder
            ->set(HttpFoundationExtension::class)
            ->withTag('form.extension');

        $builder
            ->set(ValidatorExtension::class)
            ->withTag('form.validator')
            ->withArgument(
                'validator',
                Reference::service(ValidatorInterface::class)
            );


        $builder
            ->set(FormFactoryInterface::class)
            ->factory(
                function (
                    #[InjectTaggedServices('form.extension')] array $extensions
                ): FormFactoryInterface {
                    $formFactoryBuilder = Forms::createFormFactoryBuilder();
                    foreach ($extensions as $extension) {
                        $formFactoryBuilder->addExtension($extension);
                    }
                    return $formFactoryBuilder->getFormFactory();
                }
            );

        $builder
            ->set(FormExtension::class)
            ->withTag('form.extension');

        $builder
            ->set(TwigRendererEngine::class)
            ->factory(
                function (Environment $twig) use ($config) {
                    return new TwigRendererEngine(
                        $config->getFormThemes(),
                        $twig
                    );
                }
            );


        /**
         * TODO: CSRF token manager
         */
        $builder
            ->set(FormRenderer::class)
            ->withTag('twig.runtime_loader')
            ->withArgument(
                'engine',
                Reference::service(FormRenderer::class)
            );
    }

    public function getParentServiceProviders(): array
    {
        return [
            TwigProvider::class,
            SymfonyValidatorProvider::class,
            SymfonyTranslatorProvider::class
        ];
    }

    public function getDefaultConfigurationObject(): ConfigNodeInterface
    {
        return new FormsConfig();
    }
}