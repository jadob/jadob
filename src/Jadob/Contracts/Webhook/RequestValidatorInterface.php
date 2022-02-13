<?php
declare(strict_types=1);

namespace Jadob\Contracts\Webhook;

use Symfony\Component\HttpFoundation\Request;

/**
 * Allows to verify legitimacy of incoming webhook.
 * @author pizzaminded <miki@calorietool.com>
 * @license MIT
 */
interface RequestValidatorInterface
{
    public function validate(Request $request): void;
}