<?php

declare(strict_types=1);

namespace App\Commands\Auth;

use Illuminate\Http\Request;
use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;

final class LoginCommand
{
    public function __construct(
        private readonly string $email,
        private readonly string $password,
        private readonly bool $hasRemember,
        private readonly string $ip
    )
    {
    }

    public static function fromRequest(Request $request): LoginCommand
    {
        return new LoginCommand(
            $request->get('email'),
            $request->get('password'),
            $request->get('remember', false),
            $request->ip()
        );
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return bool
     */
    public function hasRemember(): bool
    {
        return $this->hasRemember;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    #[Pure]
    #[ArrayShape(['email' => "string", 'password' => "string"])]
    public function getCredentials(): array
    {
        return [
            'email' =>$this->getEmail(),
            'password' =>$this->getPassword(),
        ];
    }
}
