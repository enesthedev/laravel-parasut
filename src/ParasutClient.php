<?php

namespace Enes\Parasut;

use Enes\Parasut\Enums\AuthorizationType;
use Enes\Parasut\Exceptions\AuthorizationException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Cache;
use Psr\SimpleCache\InvalidArgumentException;

class ParasutClient
{
    public AuthorizationType $authorizationType;
    public ParasutHttpClient $http;

    const CACHE_KEY = 'parasut:authorization:credentials';

    public function __construct(AuthorizationType $authorizationType)
    {
        $this->authorizationType = $authorizationType;
        $this->http = new ParasutHttpClient();
    }

    /**
     * @throws AuthorizationException
     * @throws InvalidArgumentException
     * @throws ConnectionException
     */
    public function authorize(): object
    {
        $token = null;

        if ($this->cache()->has(self::CACHE_KEY)) {
            $token = json_decode($this->cache()->get(self::CACHE_KEY));
        }

        if ($token == null) {
            $response = match ($this->authorizationType) {
                AuthorizationType::PASSWORD => $this->authorizeWithPassword(),
            };

            $token = json_decode($response);
            $this->cache()->put(self::CACHE_KEY, $response, now()->addSeconds($token->expires_in));
        }

        $this->http->setAuthorization($token);

        return $token;
    }

    /**
     * @throws AuthorizationException
     * @throws ConnectionException
     */
    private function authorizeWithPassword(): string
    {
        $this->validateClientId();
        $this->validateClientSecret();
        $this->validateUsername();
        $this->validatePassword();

        $response = $this->http->post(
            '/oauth/token',
            [
                'client_id' => config('parasut.client_id'),
                'client_secret' => config('parasut.client_secret'),
                'username' => config('parasut.username'),
                'password' => config('parasut.password'),
                'grant_type' => $this->authorizationType->value,
                'redirect_uri' => config('parasut.redirect_url'),
            ]
        );

        if (!$response->ok()) {
            throw new AuthorizationException("Authorization failed with status code: " . $response->status());
        }

        return $response->body();
    }

    /**
     * @throws AuthorizationException
     */
    private function validateClientId(): void
    {
        if (empty(config('parasut.client_id'))) {
            throw new AuthorizationException("Missing client_id configuration. Please set the PARASUT_CLIENT_ID environment variable.");
        }
    }

    /**
     * @throws AuthorizationException
     */
    private function validateClientSecret(): void
    {
        if (empty(config('parasut.client_secret'))) {
            throw new AuthorizationException("Missing client_secret configuration. Please set the PARASUT_CLIENT_SECRET environment variable.");
        }
    }

    /**
     * @throws AuthorizationException
     */
    private function validateUsername(): void
    {
        if (empty(config('parasut.username'))) {
            throw new AuthorizationException("Missing username configuration. Please set the PARASUT_USERNAME environment variable.");
        }
    }

    /**
     * @throws AuthorizationException
     */
    private function validatePassword(): void
    {
        if (empty(config('parasut.password'))) {
            throw new AuthorizationException("Missing password configuration. Please set the PARASUT_PASSWORD environment variable.");
        }
    }

    private function cache(): \Illuminate\Contracts\Cache\Repository
    {
        return Cache::store('file');
    }
}
