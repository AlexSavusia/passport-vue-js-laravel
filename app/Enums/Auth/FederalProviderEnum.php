<?php

declare(strict_types=1);

namespace App\Enums\Auth;

enum FederalProviderEnum: string
{
	case FACEBOOK = 'facebook';
    case GOOGLE = 'google';
    case SITE = 'site';
    case APPLE = 'apple';

	public static function isAllowed(string $provider): bool
	{
		return in_array($provider, array_column(FederalProviderEnum::cases(), 'value'));
	}
}
