<?php
declare(strict_types=1);

namespace Jadob\Container\Compiler;

use Jadob\Contracts\DependencyInjection\Attribute\InjectParameter;
use Jadob\Contracts\DependencyInjection\Attribute\InjectService;
use Jadob\Contracts\DependencyInjection\Attribute\InjectTaggedServices;
use Jadob\Contracts\DependencyInjection\Reference;
use LogicException;
use ReflectionParameter;

/**
 * @internal
 */
final readonly class ArgumentInjectHintsHandler
{
    public static function process(
        ReflectionParameter $parameter,
    ): Reference|false {
        $injectServiceAttrs = $parameter->getAttributes(InjectService::class);

        if (count($injectServiceAttrs) > 1) {
            throw new LogicException('More than one #[InjectService] attribute is attached to constructor property.');
        }

        if (count($injectServiceAttrs) === 1) {
            /** @var InjectService $attr */
            $attr = $injectServiceAttrs[0]->newInstance();

            return Reference::service($attr->serviceId);
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