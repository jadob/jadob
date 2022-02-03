<?php
declare(strict_types=1);

namespace Jadob\Typed\Aws\Lambda;

/**
 * @see https://github.com/DefinitelyTyped/DefinitelyTyped/blob/master/types/aws-lambda/trigger/eventbridge.d.ts
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 */
class EventBridgeEvent
{
    protected string $id;
    protected string $version;
    protected string $account;
    protected string $time;
    protected string $region;
    /**
     * @var string[]
     */
    protected array $resources;
    protected string $source;
    /**
     * @var string
     */
    protected string $detailType; // detail-type
    /**
     * @var array
     */
    protected array $detail;
}