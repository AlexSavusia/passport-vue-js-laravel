<?php

declare(strict_types=1);

namespace App\Events\Registration;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class RegistrationNotAllowedEmailDomain
{
	use Dispatchable, InteractsWithSockets, SerializesModels;

	public function __construct(
        private readonly string $email
    )
	{}
}
