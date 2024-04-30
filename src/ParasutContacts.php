<?php

namespace Enes\Parasut;

use Enes\Parasut\Exceptions\AuthorizationException;
use Enes\Parasut\Exceptions\ParasutHTTPException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Psr\SimpleCache\InvalidArgumentException;

class ParasutContacts
{
    private ParasutClient $client;

    private string $companyId;

    private string $apiVersion;

    public function __construct(ParasutClient $client)
    {
        $this->client = $client;
        $this->companyId = config('parasut.company_id');
        $this->apiVersion = 'v4';
    }

    /**
     * @throws ConnectionException
     * @throws AuthorizationException
     * @throws InvalidArgumentException
     */
    public function index(int $pageNumber = 1, int $paginationSize = 15, array $parameters = []): Response
    {
        $this->client->authorize();

        $parameters['page[number]'] = $pageNumber;
        $parameters['page[size]'] = $paginationSize;

        return $this->client->http->get(
            "{$this->apiVersion}/{$this->companyId}/contacts",
            $parameters,
        );
    }

    /**
     * @throws AuthorizationException
     * @throws ConnectionException
     * @throws ParasutHTTPException
     * @throws InvalidArgumentException
     */
    public function isTaxNumberRegistered(string $taxNumber): ?string
    {
        $response = $this->index(parameters: ['filter[tax_number]' => $taxNumber]);

        if (! $response->ok()) {
            throw new ParasutHTTPException('Unable to retrieve contact details.');
        }

        $data = $response->json()['data'];

        return count($data) > 0 ? $data[0] : null;
    }

    /**
     * @throws AuthorizationException
     * @throws InvalidArgumentException
     * @throws ConnectionException
     */
    public function create($data): Response
    {
        $this->client->authorize();

        return $this->client->http->post(
            "{$this->apiVersion}/{$this->companyId}/contacts",
            $data,
        )->json();
    }
}
