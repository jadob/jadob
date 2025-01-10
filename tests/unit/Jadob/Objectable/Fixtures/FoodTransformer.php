<?php

namespace Jadob\Objectable\Fixtures;

use Jadob\Objectable\Transformer\ItemTransformerInterface;

class FoodTransformer implements ItemTransformerInterface
{

    public function supports(string $className, string $context): bool
    {
        return $className === Food::class && $context === 'RECIPE_BOOK';
    }

    /**
     * @param object&Food $object
     * @return array
     */
    public function process(object $object): array
    {
        return [
            'name' => mb_strtoupper($object->name)
        ];
    }
}