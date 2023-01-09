<?php

declare(strict_types=1);

namespace App\Commands\Registration;

use App\Commands\RedirectCommand;
use App\Http\Requests\Request;

final class TempRegistrationCommand
{
    public function __construct(
        private readonly string $firstName,
        private readonly string $lastName,
        private readonly string $email,
        private readonly string $password,
        private readonly RedirectCommand $redirectCommand
    ) {
    }

    public static function fromRequest(Request $request): TempRegistrationCommand
    {
        return new TempRegistrationCommand(
            $request->get('first_name'),
            $request->get('last_name'),
            $request->get('email'),
            $request->get('password'),
            $request->getRedirectCommand()
        );
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
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
     * @return RedirectCommand
     */
    public function getRedirectCommand(): RedirectCommand
    {
        return $this->redirectCommand;
    }
}
