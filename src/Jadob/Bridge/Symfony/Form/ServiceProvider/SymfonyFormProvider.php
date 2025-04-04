<?php
declare(strict_types=1);

namespace Jadob\Bridge\Symfony\Form\ServiceProvider;

use Closure;
use Exception;
use Jadob\Bridge\Symfony\Validator\ServiceProvider\SymfonyValidatorProvider;
use Jadob\Bridge\Twig\ServiceProvider\TwigProvider;
use Jadob\Container\Container;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Framework\ServiceProvider\SymfonyTranslatorProvider;
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
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class SymfonyFormProvider implements ServiceProviderInterface, ParentServiceProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigNode(): ?string
    {
        return 'forms';
    }

    public function register(ContainerInterface $container, object|null|array $config = null): array
    {
        $services = [];

        $services[HttpFoundationExtension::class] = [
            'tags' => [
                'form.extension'
            ],
            'class' => HttpFoundationExtension::class
        ];

        $services[ValidatorExtension::class] = [
            'tags' => [
                'form.extension'
            ],
            'factory' => static function (ValidatorInterface $validator): ValidatorExtension {
                return new ValidatorExtension(
                    $validator
                );
            }
        ];

        $services[FormFactoryInterface::class] = static function (Container $container): FormFactoryInterface {
            $formFactoryBuilder = Forms::createFormFactoryBuilder();

            /** @var FormExtensionInterface $extensions */
            $extensions = $container->getTaggedServices('form.extension');

            foreach ($extensions as $extension) {
                $formFactoryBuilder->addExtension($extension);
            }

            return $formFactoryBuilder->getFormFactory();
        };

        $services[FormExtension::class] = [
            'tags' => ['twig.extension'],
        ];

        $services[TwigRendererEngine::class] = [
            'factory' => static function (Environment $twig) use ($config): TwigRendererEngine {
                if (!array_key_exists('forms', $config)) {
                    throw new Exception('There is no `forms` key in `translator` node.');
                }

                if (count($config['forms']) === 0) {
                    throw new Exception('There is no form layouts defined in `translator` node.');
                }

                return new TwigRendererEngine($config['forms'], $twig);
            }
        ];
        $services[FormRenderer::class] = [
            'tags' => ['twig.runtime_loader'],
            'factory' => static function (TwigRendererEngine $rendererEngine): Closure {
                return function () use ($rendererEngine): FormRenderer {
                    return new FormRenderer($rendererEngine);
                };
            }
        ];

        return $services;
    }

    public function getParentServiceProviders(): array
    {
        return [
            TwigProvider::class,
            SymfonyValidatorProvider::class,
            SymfonyTranslatorProvider::class
        ];
    }
}