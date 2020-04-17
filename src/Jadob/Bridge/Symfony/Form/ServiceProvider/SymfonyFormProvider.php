<?php
declare(strict_types=1);

namespace Jadob\Bridge\Symfony\Form\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormRenderer;
use Symfony\Component\Form\Forms;
use Symfony\Component\Validator\Validation;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\RuntimeLoader\FactoryRuntimeLoader;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class SymfonyFormProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigNode()
    {
        return 'forms';
    }

    /**
     * {@inheritdoc}
     *
     * @return (\Closure|\Symfony\Component\Validator\Validator\ValidatorInterface)[]
     *
     * @psalm-return array{symfony.validator: \Symfony\Component\Validator\Validator\ValidatorInterface, symfony.form.factory: \Closure(Container):\Symfony\Component\Form\FormFactoryInterface}
     * @throws \ReflectionException
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     *
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     */
    public function register($config)
    {

        //TODO move to parent provider
        $validator = Validation::createValidatorBuilder();

        return [
            'symfony.validator' => $validator->getValidator(),
            'symfony.form.factory' => static function (Container $container) {
                $formFactoryBuilder = Forms::createFormFactoryBuilder()
                    ->addExtension(new HttpFoundationExtension())
                    ->addExtension(new ValidatorExtension($container->get('symfony.validator')));

                return $formFactoryBuilder->getFormFactory();
            }
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        if ($container->has('twig')) {
            /**
             * @var \Twig\Environment $twig
             */
            $twig = $container->get('twig');
            $formEngine = new TwigRendererEngine($config['forms'], $twig);

            $twig->addRuntimeLoader(
                new FactoryRuntimeLoader(
                    [
                        FormRenderer::class => function () use ($formEngine) {
                            return new FormRenderer($formEngine);
                        },
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


    }
}