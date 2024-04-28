<?php

namespace Enes\Parasut;

use Enes\Parasut\Enums\AuthorizationType;

class ParasutClient
{
    public AuthorizationType $authorizationType;

    public function __construct(AuthorizationType $authorizationType)
    {
        $this->authorizationType = $authorizationType;
    }
}
