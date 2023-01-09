<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Throwable;

class BusinessException extends Exception
{
    const MAPPING = [];

    public function __construct(int $code = 0, string $message = "", ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getUserMessage(): string
    {
        return __(static::MAPPING[$this->code]);
    }
}
