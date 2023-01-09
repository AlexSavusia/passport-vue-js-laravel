<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Throwable;

final class TokenException extends Exception
{
    const FAILED_TO_LOAD_PUBLIC_KEY = 1;
    const FAILED_TO_LOAD_PRIVATE_KEY = 2;

    const ERRORS = [
        self::FAILED_TO_LOAD_PUBLIC_KEY => 'failed to load public key',
        self::FAILED_TO_LOAD_PRIVATE_KEY => 'failed to load private key',
    ];

    public function __construct(int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(self::ERRORS[$code] ?? 'undefined error', $code, $previous);
    }
}
