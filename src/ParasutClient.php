<?php

namespace Enes\Parasut;

use Enes\Parasut\Enums\AuthorizationType;
use Enes\Parasut\Exceptions\InvalidAuthorizationTypeException;

class ParasutClient
{
    public AuthorizationType $authorizationType;

    public function __construct(AuthorizationType $authorizationType)
    {
        $this->authorizationType = $authorizationType;
    }
}
