<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Enums\Auth\FederalProviderEnum;
use App\Exceptions\Auth\LoginException;
use App\Exceptions\TokenException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request;
use App\Services\Auth\AuthRedirectService;
use App\Services\Auth\FederalLoginService;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Throwable;

final class FederalLoginController extends Controller
{
    public function __construct(
        private readonly FederalLoginService $socialLoginService
    ) {
    }

    /**
     * @param  string  $provider
     *
     * @return RedirectResponse
     */
    public function redirectToProvider(string $provider): RedirectResponse
    {
        if (!FederalProviderEnum::isAllowed($provider)) {
            abort(403);
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * @param  Request $request
     * @param  string  $provider
     *
     * @return RedirectResponse
     * @throws TokenException
     */
    public function login(Request $request, string $provider): RedirectResponse
    {
        try {
            $user = $this->socialLoginService->handle($provider);
            if (!$user) {
                throw new LoginException(LoginException::CODE_FAILED_AUTH);
            }

            Auth::login($user);
        } catch (Throwable $exception) {
            return redirect()
                ->route('auth.login')
                ->withErrors($exception->getMessage());
        }

        return AuthRedirectService::redirect($request->getRedirectCommand(), $request->getClientIp());
    }
}
