<?php

use Enes\Parasut\Enums\AuthorizationType;
use Enes\Parasut\ParasutClient;

test('it constructs with valid authorization type', function () {
    $client = new ParasutClient(AuthorizationType::AUTHORIZATION_CODE);

    expect($client->authorizationType)->toBe(AuthorizationType::AUTHORIZATION_CODE);
});
