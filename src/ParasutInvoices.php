<?php

namespace Enes\Parasut;

use Enes\Parasut\Exceptions\AuthorizationException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Psr\SimpleCache\InvalidArgumentException;

class ParasutInvoices
{

    private ParasutClient $client;
    private string $companyId;
    private string $apiVersion;

    /**
     * @param ParasutClient $client
     */
    public function __construct(ParasutClient $client)
    {
        $this->client = $client;
        $this->companyId = config('parasut.company_id');
        $this->apiVersion = "v4";
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
            "{$this->apiVersion}/{$this->companyId}/sales_invoices",
            $data,
        );
    }

    /**
     * @param $data
     * @return Response
     * @throws AuthorizationException
     * @throws ConnectionException
     * @throws InvalidArgumentException
     */
    public function toEArchive($data): Response
    {
        $this->client->authorize();

        return $this->client->http->post(
            "{$this->apiVersion}/{$this->companyId}/e_archives",
            $data
        );
    }
}
