<?php

declare(strict_types=1);

namespace App\Exceptions\Auth;

use App\Exceptions\BusinessException;

/**
 * Class SocialLoginException
 *
 * @package App\Exceptions\Users
 */
final class SocialLoginException extends BusinessException
{
	/** @var int */
	const USER_NOT_FOUND = 1;
	/** @var int */
	const USER_ID_NOT_FOUND = 2;
	/** @var int */
	const USER_EMAIL_NOT_FOUND = 3;
	/** @var int */
	const USER_NOT_CREATED = 4;

	/** @var string[] */
	const MAPPING = [
		SocialLoginException::USER_NOT_FOUND => 'auth.socialite.no_user',
		SocialLoginException::USER_ID_NOT_FOUND => 'auth.socialite.no_user_id',
		SocialLoginException::USER_EMAIL_NOT_FOUND => 'auth.socialite.no_user_email',
		SocialLoginException::USER_NOT_CREATED => 'auth.socialite.user_not_created',
	];

	/** @var string $userMessage */
	private string $userMessage;

	/**
	 * SocialLoginException constructor.
	 *
	 * @param  int     $code
	 * @param  string  $message
	 */
	public function __construct(int $code, string $message = '')
	{
		$this->userMessage = SocialLoginException::MAPPING[$code];

		parent::__construct($code, $message);
	}

	/**
	 * @return string
	 */
	public function getUserMessage(): string
	{
		return trans($this->userMessage);
	}
}
