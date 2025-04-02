<?php
declare(strict_types=1);

namespace Jadob\Container\Exception;

use Psr\Container\NotFoundExceptionInterface;


final class ServiceNotFoundException extends \Exception implements NotFoundExceptionInterface
{
    public function __construct(
        string                 $message,
        private readonly array $resolvingChain
    )
    {
        parent::__construct($message);
    }

    /**
     * @return array
     */
    public function getResolvingChain(): array
    {
        return $this->resolvingChain;
    }
}