<?php

test('a user can create an api key and it is displayed', function () {
    $this->artisan('create:token')
        ->expectsOutputToContain('Your API Token is: ')
        ->assertExitCode(0);
});

test('a user can create an api key and it is inserted into the database', function () {
    $this->artisan('create:token')
        ->assertExitCode(0);

    $this->assertDatabaseCount(\App\Models\ApiToken::class, 1);

    $apiToken = \App\Models\ApiToken::first();

    expect($apiToken->token)->not->toBeNull();
});
