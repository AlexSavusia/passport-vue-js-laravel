<?php

declare(strict_types=1);

namespace App\Exceptions\Auth;

use App\Exceptions\BusinessException;
use Throwable;

final class LoginException extends BusinessException
{
    const CODE_FAILED_AUTH = 1;
    const CODE_EXCEEDED_AUTH_ATTEMPTS = 2;

    const MAPPING = [
        self::CODE_FAILED_AUTH => 'auth.failed',
        self::CODE_EXCEEDED_AUTH_ATTEMPTS => 'auth.throttle',
    ];
}
