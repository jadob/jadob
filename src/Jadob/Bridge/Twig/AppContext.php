<?php
declare(strict_types=1);

namespace Jadob\Bridge\Twig;

use Jadob\Core\RequestContext;
use Jadob\Core\RequestContextStore;

class AppContext
{
    public function __construct(protected RequestContextStore $contextStore)
    {
    }

    public function getRequestContext(): RequestContext
    {
        return $this->contextStore->latest();
    }
}