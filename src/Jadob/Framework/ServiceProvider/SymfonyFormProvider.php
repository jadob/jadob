<?php
declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Closure;
use Doctrine\Persistence\ManagerRegistry;
use Jadob\Container\Container;
use Jadob\Contracts\DependencyInjection\ParentProviderInterface;
use Jadob\Contracts\DependencyInjection\ParentServiceProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;
use ReflectionException;
use Symfony\Bridge\Doctrine\Form\DoctrineOrmExtension;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormRenderer;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Validation;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\RuntimeLoader\FactoryRuntimeLoader;

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

    /**
     * {@inheritdoc}
     *
     * @return (Closure|\Symfony\Component\Validator\Validator\ValidatorInterface)[]
     *
     * @throws ReflectionException
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     *
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     */
    public function register(ContainerInterface $container, object|null|array $config = null): array
    {
        //TODO move to parent provider
        $validator = Validation::createValidatorBuilder();

        return [
            'symfony.validator' => $validator->getValidator(),
            FormFactoryInterface::class => static function (Container $container): FormFactoryInterface {
                $formFactoryBuilder = Forms::createFormFactoryBuilder()
                    ->addExtension(new HttpFoundationExtension())
                    ->addExtension(new ValidatorExtension($container->get('symfony.validator')));

                //@TODO: remove this when there will be container tags implemented
                if (
                    class_exists(DoctrineOrmExtension::class)
                    && $container->has(ManagerRegistry::class)
                ) {
                    $formFactoryBuilder->addExtension(
                        new DoctrineOrmExtension($container->get(ManagerRegistry::class))
                    );
                }

                return $formFactoryBuilder->getFormFactory();
            }
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        /**
         * @var \Twig\Environment $twig
         */
        $twig = $container->get('twig');

        if (!array_key_exists('forms', $config)) {
            throw new \Exception('There is no `forms` key in `translator` node.');
        }

        if (count($config['forms']) === 0) {
            throw new \Exception('There is no form layouts defined in `translator` node.');
        }

        $formEngine = new TwigRendererEngine($config['forms'], $twig);

        $twig->addRuntimeLoader(
            new FactoryRuntimeLoader(
                [
                    FormRenderer::class => fn() => new FormRenderer($formEngine),
                ]
            )
        );

        $twig->addExtension(new FormExtension());
        $twig->addExtension(
            new TranslationExtension(
                $container->get(TranslatorInterface::class)
            )
        );
    }

    public function getParentServiceProviders(): array
    {
        return [
            TwigProvider::class
        ];
    }
}