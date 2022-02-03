<?php
declare(strict_types=1);

namespace Jadob\Objectable\Transformer;

use Jadob\Objectable\ObjectableException;

/**
 * @author pizzaminded <miki@calorietool.com>
 * @license MIT
 */
class DefaultActionFieldTransformer implements ActionFieldTransformerInterface
{

    /**
     * {@inheritdoc}
     */
    public function transformActionUrl($value, string $fieldName, string $fieldPath, ?string $propertyName): string
    {
        if ($propertyName === null) {
            throw new ObjectableException('Please provide "property" attribute for "'.$fieldName.'" action field.');
        }

        return $fieldPath.'?'.$propertyName.'='.$value;
    }

    /**
     * {@inheritdoc}
     */
    public function transformActionLabel(string $fieldLabel, string $fieldName/**, string $fieldPath **/): string
    {
        return $fieldLabel;
    }
}