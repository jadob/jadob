<?php
declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Closure;
use Jadob\Container\Container;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Form\Extension\Csrf\CsrfExtension;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Csrf\TokenGenerator\UriSafeTokenGenerator;
use Symfony\Component\Security\Csrf\TokenStorage\SessionTokenStorage;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
final readonly class CsrfProvider implements ServiceProviderInterface
{
    public function getConfigNode(): ?string
    {
        return null;
    }

    /**
     * {@inheritdoc}
     * @param array<mixed>|null $config
     * @return array<non-empty-string,Closure>
     */
    public function register(
        ContainerInterface $container,
        array|object|null $config = null
    ): array
    {
        return [
            'symfony.csrf.token.manager' => function (Container $container) {
                $csrfGenerator = new UriSafeTokenGenerator();
                $csrfStorage = new SessionTokenStorage($container->get('session'));
                return new CsrfTokenManager($csrfGenerator, $csrfStorage);
            },
            'symfony.forms.csrf.extension' => function (Container $container) {
                return new CsrfExtension($container->get('symfony.csrf.token.manager'));
            }];
    }
}