<?php

declare(strict_types=1);

namespace App\Enums\Registration;

enum TempRegistrationStatusEnum: string
{
    case SENT = 'sent';
    case RECEIVED = 'received';
}
