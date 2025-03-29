<?php

declare(strict_types=1);

namespace Jadob\Container\Fixtures\ShopDomain;

class ProductService
{

    public function __construct(
        /** @phpstan-ignore property.onlyWritten */
        private readonly ProductRepositoryInterface $productRepository,
    )
    {
    }
}