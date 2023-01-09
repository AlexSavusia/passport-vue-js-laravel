<?php

namespace App\Api;

use App\Commands\Registration\ConfirmRegistrationCommand;
use App\Commands\Registration\ConfirmRegistrationResponseCommand;
use App\Services\Tokenizer;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\RequestInterface;

final class YellowClient extends Client
{
    const REGISTRATION = 'register.php';

    public function doLogin() {}

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function doRegistration(string $token): ConfirmRegistrationCommand|ConfirmRegistrationResponseCommand
    {
        $response = $this->request('GET', self::REGISTRATION,
            [
                'allow_redirects' => [
                    'track_redirects' => true
                ],
                'query' => [
                    'token' => $token
                ],
            ]
        );

        if (empty($response->getBody()->getContents())) {
            throw new Exception('Empty response');
        }

        $response = json_decode($response->getBody(), true);
        Log::info('body', $response);
        if (isset($response['token'])) {

            return ConfirmRegistrationCommand::fromToken($response['token']);
        }

        return new ConfirmRegistrationResponseCommand(
            $response['id'] ?? null,
            $response['message'],
            $response['success'],
        );
    }
}
