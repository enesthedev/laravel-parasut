<?php

namespace Enes\Parasut;

use Enes\Parasut\Enums\AuthorizationType;

class Parasut
{
    public ParasutContacts $contacts;
    public ParasutInvoices $invoices;

    /**
     * @param ParasutClient $client
     */
    public function __construct(ParasutClient $client)
    {
        $this->contacts = new ParasutContacts($client);
        $this->invoices = new ParasutInvoices($client);
    }

    /**
     * @return ParasutInvoices
     */
    public function invoices(): ParasutInvoices
    {
        return $this->invoices;
    }

    /**
     * @return ParasutContacts
     */
    public function contacts(): ParasutContacts
    {
        return $this->contacts;
    }
}
