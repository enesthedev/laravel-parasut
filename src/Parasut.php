<?php

namespace Enes\Parasut;

class Parasut
{
    public ParasutContacts $contacts;

    public ParasutInvoices $invoices;

    public function __construct(ParasutClient $client)
    {
        $this->contacts = new ParasutContacts($client);
        $this->invoices = new ParasutInvoices($client);
    }

    public function invoices(): ParasutInvoices
    {
        return $this->invoices;
    }

    public function contacts(): ParasutContacts
    {
        return $this->contacts;
    }
}
