<?php

namespace Enes\Parasut;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class ParasutHttpClient
{
    protected string $baseUrl;

    private ?object $authorization = null;

    public function __construct(string $baseUrl = 'https://api.parasut.com')
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @throws ConnectionException
     */
    public function get(string $uri, array $params = []): \Illuminate\Http\Client\Response
    {
        return Http::withHeaders($this->getDefaultHeaders())
            ->get($this->getUrl($uri), http_build_query($params));
    }

    /**
     * @throws ConnectionException
     */
    public function post(string $uri, array $data = []): \Illuminate\Http\Client\Response
    {
        return Http::withHeaders($this->getDefaultHeaders())
            ->post($this->getUrl($uri), $data);
    }

    /**
     * @throws ConnectionException
     */
    public function put(string $uri, array $data = []): \Illuminate\Http\Client\Response
    {
        return Http::withHeaders($this->getDefaultHeaders())
            ->put($this->getUrl($uri), $data);
    }

    /**
     * @throws ConnectionException
     */
    public function delete(string $uri, array $data = []): \Illuminate\Http\Client\Response
    {
        return Http::withHeaders($this->getDefaultHeaders())
            ->delete($this->getUrl($uri), $data);
    }

    public function setAuthorization($authorization): void
    {
        $this->authorization = $authorization;
    }

    protected function getUrl(string $uri): string
    {
        return rtrim($this->baseUrl, '/').'/'.ltrim($uri, '/');
    }

    protected function getDefaultHeaders(): array
    {
        $headers = [];

        if ($this->authorization) {
            $headers['Authorization'] = 'Bearer '.$this->authorization->access_token;
        }

        return $headers;
    }
}
