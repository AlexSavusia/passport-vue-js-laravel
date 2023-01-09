<?php

declare(strict_types=1);

namespace App\Commands\Registration;

use App\Exceptions\TokenException;
use App\Services\Tokenizer;

final class ConfirmRegistrationCommand
{
    public function __construct(
        private readonly int|null $id,
        private readonly int $tempId,
        private readonly string $message,
        private readonly bool $success,
    ){}

    /**
     * @throws TokenException
     */
    public static function fromToken(string $token): ConfirmRegistrationCommand
    {
        $data = Tokenizer::decrypt($token);

        return new ConfirmRegistrationCommand(
            $data->wp_id, $data->id, $data->message, $data->success
        );
    }

    /**
     * @return int|null
     */
    public function getId(): int|null
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getTempId(): int
    {
        return $this->tempId;
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
