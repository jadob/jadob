<?php

namespace Jadob\Container\Compiler;

use Jadob\Contracts\DependencyInjection\Attribute\InjectParameter;
use Jadob\Contracts\DependencyInjection\Attribute\InjectService;
use Jadob\Contracts\DependencyInjection\Attribute\InjectTaggedServices;
use Jadob\Contracts\DependencyInjection\Reference;

/**
 * @internal
 */
final readonly class ArgumentInjectHintsHandler
{
    public static function process(
        \ReflectionParameter $parameter,
    ): Reference|false
    {
        $injectServiceAttrs = $parameter->getAttributes(InjectService::class);
        if (count($injectServiceAttrs) > 0) {
            throw new LogicException('Not implemented');
        }

        $injectParameterAttrs = $parameter->getAttributes(InjectParameter::class);
        if (count($injectParameterAttrs) > 0) {
            /** @var InjectParameter $attr */
            $attr = $injectParameterAttrs[0]->newInstance();

            return Reference::param($attr->parameter);
        }

        $injectTaggedAttrs = $parameter->getAttributes(InjectTaggedServices::class);
        if (count($injectTaggedAttrs) > 0) {
            /** @var InjectTaggedServices $attr */
            $attr = $injectTaggedAttrs[0]->newInstance();

            return Reference::taggedServices($attr->tag);
        }

        return false;
    }

}