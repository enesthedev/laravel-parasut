<?php

use Enes\Parasut\ParasutClient;
use Enes\Parasut\Enums\AuthorizationType;
use Enes\Parasut\Exceptions\InvalidAuthorizationTypeException;

test('it constructs with valid authorization type', function () {
    $client = new ParasutClient(AuthorizationType::AUTHORIZATION_CODE);

    expect($client->authorizationType)->toBe(AuthorizationType::AUTHORIZATION_CODE);
});
