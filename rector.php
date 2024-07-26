<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;

return RectorConfig::configure()
    ->withPaths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ])
    // uncomment to reach your current PHP version
    ->withPhpSets(
        php83: true
    )
    ->withRules([
        \Rector\CodeQuality\Rector\Include_\AbsolutizeRequireAndIncludePathRector::class,
        \Rector\CodeQuality\Rector\LogicalAnd\AndAssignsToSeparateLinesRector::class,
        \Rector\CodeQuality\Rector\FuncCall\ArrayMergeOfNonArraysToSimpleArrayRector::class,
        \Rector\CodeQuality\Rector\FuncCall\ChangeArrayPushToArrayAssignRector::class,
        \Rector\CodeQuality\Rector\NullsafeMethodCall\CleanupUnneededNullsafeOperatorRector::class,
        \Rector\CodeQuality\Rector\Assign\CombinedAssignRector::class,
        \Rector\CodeQuality\Rector\If_\CombineIfRector::class,
        \Rector\CodeQuality\Rector\If_\CompleteMissingIfElseBracketRector::class,
        \Rector\CodeQuality\Rector\If_\ConsecutiveNullCompareReturnsToNullCoalesceQueueRector::class,
        \Rector\CodeQuality\Rector\ClassConstFetch\ConvertStaticPrivateConstantToSelfRector::class,
        \Rector\CodeQuality\Rector\If_\ExplicitBoolCompareRector::class,
        \Rector\CodeQuality\Rector\Identical\FlipTypeControlToUseExclusiveTypeRector::class,
        \Rector\CodeQuality\Rector\For_\ForRepeatedCountToOwnVariableRector::class,
        \Rector\CodeQuality\Rector\Foreach_\ForeachToInArrayRector::class,
        \Rector\CodeQuality\Rector\ClassMethod\InlineArrayReturnAssignRector::class,
        \Rector\CodeQuality\Rector\Expression\InlineIfToExplicitIfRector::class,
        \Rector\CodeQuality\Rector\FuncCall\InlineIsAInstanceOfRector::class,
        \Rector\CodeQuality\Rector\Isset_\IssetOnPropertyObjectToPropertyExistsRector::class,
        \Rector\CodeQuality\Rector\New_\NewStaticToNewSelfRector::class,
        \Rector\CodeQuality\Rector\FuncCall\RemoveSoleValueSprintfRector::class,
        \Rector\CodeQuality\Rector\Foreach_\SimplifyForeachToCoalescingRector::class,
        \Rector\Php84\Rector\Param\ExplicitNullableParamTypeRector::class

    ])
    ->withTypeCoverageLevel(0);
