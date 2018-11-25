<?php

namespace Jadob\SymfonyFormBridge\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\FormExtensionInterface;
use Symfony\Component\Form\FormRenderer;
use Symfony\Component\Form\Forms;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Validation;

/**
 * Class SymfonyFormProvider
 * @package Jadob\SymfonyFormBridge\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license proprietary
 */
class SymfonyFormProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigNode()
    {
        return 'sf_forms';
    }

    /**
     * {@inheritdoc}
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     * @throws \ReflectionException
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function register(ContainerBuilder $container, $config)
    {


    }

    /**
     * Stuff that's needed to be done after container is built.
     * What can you do using these method?
     * - This one gets container as a first argument, so, you can e.g. get all services implementing SomeCoolInterface,
     * and inject them somewhere
     * (example 1: using Twig, you can register all extensions)
     * (example 2: EventListener registers all Listeners here)
     * - You can add new services of course
     *
     * @param Container $container
     * @param array|null $config the same config node as passed in register()
     * @return void
     */
    public function onContainerBuild(Container $container, $config)
    {

        $container->add('symfony.form.factory', function (Container $container) use ($config) {
            /** @var \Twig\Environment $twig */
            $twig = $container->get('twig');

            /** @var Translator $translator */
            $translator = $container->get('translator');

            $formEngine = new TwigRendererEngine($config['forms'], $twig);
            $twig->addRuntimeLoader(new \Twig_FactoryRuntimeLoader([
                FormRenderer::class => function () use ($formEngine) {
                    return new FormRenderer($formEngine);
                },
            ]));


            $twig->addExtension(new FormExtension());
            $twig->addExtension(
                new TranslationExtension(
                    $container->get('translator')
                )
            );

            $formFactoryBuilder = Forms::createFormFactoryBuilder()
                ->addExtension(new HttpFoundationExtension());

//            $formExtensions = $container->getObjectsImplementing(FormExtensionInterface::class);

//            r($formExtensions);



            return $formFactoryBuilder->getFormFactory();
        });
    }
}