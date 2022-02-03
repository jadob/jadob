<?php
declare(strict_types=1);

namespace Jadob\Objectable\Transformer;

use Jadob\Objectable\Annotation\ActionField;

/**
 * @author pizzaminded <miki@calorietool.com>
 * @license MIT
 */
interface ActionFieldTransformerInterface
{
    /**
     * @param ActionField $actionField Annotation taken from given entity
     * @param object $entity Currently processed entity
     * @return string
     */
    public function transformActionUrl(ActionField $actionField, object $entity): string;

    /**
     * Allows to transform given label in user-defined way.
     * @param ActionField $actionField Annotation taken from given entity
     * @param object $entity Currently processed entity
     * @return string
     */
    public function transformActionLabel(ActionField $actionField, object $entity): string;
}