<?php

declare(strict_types=1);

namespace App\Commands;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\InputBag;

final class RedirectCommand
{
    public function __construct(
        private readonly string $authPath,
        private readonly string $returnPath
    ) {
    }

    public static function fromCookies(InputBag $cookies): RedirectCommand
    {
        return new RedirectCommand(
            config('services.yellow.auth'),
            $cookies->get('return_path') ?? env('APP_DEFAULT_REDIRECT_URL')
        );
    }

    public static function fromRequest(Request $request): RedirectCommand
    {
        if ($request->get('ret_path') !== null) {
            $returnPath = $request->get('ret_path');
        }

        if ($request->get('return_path') !== null) {
            $returnPath = $request->get('return_path');
        }

        return new RedirectCommand(
            config('services.yellow.auth'),
            $returnPath ?? env('APP_DEFAULT_REDIRECT_URL'),
        );
    }

    /**
     * @return string
     */
    public function getAuthPath(): string
    {
        return $this->authPath;
    }

    /**
     * @return string
     */
    public function getReturnPath(): string
    {
        return $this->returnPath;
    }
}
