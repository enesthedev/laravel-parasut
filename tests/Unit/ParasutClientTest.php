<?php

use Enes\Parasut\Exceptions\AuthorizationException;
use Enes\Parasut\ParasutClient;
use Enes\Parasut\Enums\AuthorizationType;
use Enes\Parasut\ParasutHttpClient;

test('it throws exception for missing username on authorization (Password)', function () {
    $client = new ParasutClient(AuthorizationType::PASSWORD);

    config(['parasut.client_id' => 'some-client-id']);
    config(['parasut.client_secret' => 'some-client-secret']);

    $this->expectException(AuthorizationException::class);
    $this->expectExceptionMessage("Missing username configuration. Please set the PARASUT_USERNAME environment variable.");

    $client->authorize();
});

test('it throws exception for missing password on authorization (Password)', function () {
    $client = new ParasutClient(AuthorizationType::PASSWORD);

    config(['parasut.client_id' => 'some-client-id']);
    config(['parasut.client_secret' => 'some-client-secret']);
    config(['parasut.username' => 'some-username']);

    $this->expectException(AuthorizationException::class);
    $this->expectExceptionMessage("Missing password configuration. Please set the PARASUT_PASSWORD environment variable.");

    $client->authorize();
});

