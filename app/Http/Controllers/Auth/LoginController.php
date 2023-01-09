<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Request;
use App\Services\Auth\AuthRedirectService;
use App\Services\Auth\AuthService;
use App\Services\Auth\LoginService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

final class LoginController extends Controller
{
    /**
     * @param  LoginService  $loginService
     */
    public function __construct(
        private readonly LoginService $loginService
    ) {
    }

    /**
     * @param  Request  $request
     *
     * @return View
     */
    public function index(Request $request): View
    {
        Log::info("[IP: {$request->getClientIp()}] Пользователь, запросил форму авторизации.");

        return view('auth.login', [
            'redirect' => $request->getRedirectCommand(),
        ]);
    }

// /**
//  * @param  LoginRequest  $request
//  *
//  * @return RedirectResponse
//  * @throws Exception
//  */
// public function login(LoginRequest $request): RedirectResponse
// {
//     Log::info("[IP: {$request->getClientIp()}] Пользователь, пытается авторизоваться.");
//
//     $command = $request->getCommand();
//
//     try {
//         $this->loginService->handle($command);
//
//         $token = AuthService::makeAuthenticationToken();
//
//         Log::info("[IP: {$request->getClientIp()}] Пользователь, успешно авторизовался {$token}.");
//     } catch (BusinessException $exception) {
//         Log::warning("[IP: {$request->getClientIp()}] Пользователь, не авторизован. {$exception->getMessage()}.");
//         return redirect()
//             ->back()
//             ->withErrors($exception->getUserMessage());
//     }
//
//     return $this->authRedirect($command->getRedirectCommand(), $token);
// }
    /**
     * @throws Exception
     */
    public function login(LoginRequest $request): JsonResponse
    {
        Log::info("[IP: {$request->getClientIp()}] Пользователь, пытается авторизоваться.");

        $command = $request->getCommand();

        try {
            $this->loginService->handle($command);

            $token = AuthService::makeAuthenticationToken();

            Log::info("[IP: {$request->getClientIp()}] Пользователь, успешно авторизовался {$token}.");
        } catch (BusinessException $exception) {
            Log::warning("[IP: {$request->getClientIp()}] Пользователь, не авторизован. {$exception->getMessage()}.");

            return response()->json([
               'message' => $exception->getUserMessage(),
            ]);
        }

        return response()->json([
            'redirect' => AuthRedirectService::redirectJson($request->getRedirectCommand(), $request->getClientIp()),
        ]);
    }
}
