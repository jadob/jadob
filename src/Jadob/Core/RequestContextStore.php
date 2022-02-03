<?php
declare(strict_types=1);

namespace Jadob\Core;

use RuntimeException;

class RequestContextStore
{
    protected array $stack = [];

    public function push(RequestContext $context)
    {
        $this->stack[] = $context;
    }
    public function latest(): RequestContext
    {
        if (count($this->stack) === 0 ) {
            throw new RuntimeException('There is no Request Context added to stack.');
        }

        return $this->stack[count($this->stack)-1];
    }
}