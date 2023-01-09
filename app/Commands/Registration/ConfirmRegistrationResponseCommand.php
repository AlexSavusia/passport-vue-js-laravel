<?php

declare(strict_types=1);

namespace App\Commands\Registration;

final class ConfirmRegistrationResponseCommand
{
    public function __construct(
        private readonly int|null $id,
        private readonly string $message,
        private readonly bool $success,
    ){}

    /**
     * @return int|null
     */
    public function getId(): int|null
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }
}
