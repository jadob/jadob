<?php

namespace Jadob\SymfonyFormBridge\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Symfony\Bridge\Twig\Extension\FormExtension;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Bridge\Twig\Form\TwigRenderer;
use Symfony\Bridge\Twig\Form\TwigRendererEngine;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormRenderer;
use Symfony\Component\Form\Forms;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\ValidatorBuilder;

/**
 * Class SymfonyFormProvider
 * @package Jadobable\SymfonyFormBridge\ServiceProvider
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
    public function register(Container $container, $config)
    {
        /** @var \Twig\Environment $twig */
        $twig = $container->get('twig');

        /** @var Translator $translator */
        $translator = $container->get('translator');

        $translator->addLoader('xlf',new XliffFileLoader());

        $validatorPath = \dirname((new \ReflectionClass(Validation::class))->getFileName()).'/Resources/translations/validators.pl.xlf';

        $translator->addResource('xlf', $validatorPath, $translator->getLocale());

        $validatorBuilder = new ValidatorBuilder();
        $validatorBuilder->setTranslator($container->get('translator'));
        $validator = $validatorBuilder->getValidator();

        $formEngine = new TwigRendererEngine($config['forms'], $twig);

        $twig->addExtension(new FormExtension());
        $twig->addExtension(
            new TranslationExtension(
                $container->get('translator')
            )
        );
        $twig->addRuntimeLoader(new \Twig_FactoryRuntimeLoader([
            FormRenderer::class => function () use ($formEngine) {
                return new FormRenderer($formEngine);
            },
        ]));

        $twig->addRuntimeLoader(new \Twig_FactoryRuntimeLoader([
            FormRenderer::class => function () use ($formEngine) {
                return new TwigRenderer($formEngine);
            },
        ]));

        $csrfGenerator = new UriSafeTokenGenerator();
        $csrfStorage = new SessionTokenStorage($container->get('session'));
        $csrfManager = new CsrfTokenManager($csrfGenerator, $csrfStorage);

        $container->add('sf.forms', Forms::createFormFactoryBuilder()
            ->addExtension(new HttpFoundationExtension()) //This will be needed as we use http-foundation component
            ->addExtension(new ValidatorExtension($validator))
            ->addExtension(new CsrfExtension($csrfManager))
        );

        $container->add('sf.form.factory', $container->get('sf.forms')->getFormFactory());


    }
}