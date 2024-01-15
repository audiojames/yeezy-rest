<?php

test('a user can receive 5 quotes', function () {
    setupToken();

    Http::fake([
        'https://api.kanye.rest' => Http::sequence()
            ->push(['quote' => 'quote 1'])
            ->push(['quote' => 'quote 2'])
            ->push(['quote' => 'quote 3'])
            ->push(['quote' => 'quote 4'])
            ->push(['quote' => 'quote 5']),
    ]);

    $response = $this->get('/api/quotes?token=my-token');

    $response->assertStatus(200);

    expect($response->json())->toBe([
        'quote 1',
        'quote 2',
        'quote 3',
        'quote 4',
        'quote 5',
    ]);

});

test('a user can receive 5 new quotes', function () {
    setupToken();

    Http::fake([
        'https://api.kanye.rest' => Http::sequence()
            ->push(['quote' => 'quote 6'])
            ->push(['quote' => 'quote 7'])
            ->push(['quote' => 'quote 8'])
            ->push(['quote' => 'quote 9'])
            ->push(['quote' => 'quote 10']),
    ]);

    $response = $this->get('/api/fresh-quotes?token=my-token');

    $response->assertStatus(200);

    expect($response->json())->toBe([
        'quote 6',
        'quote 7',
        'quote 8',
        'quote 9',
        'quote 10',
    ]);
});

test('a user can receive 5 new quotes that are different to the first 5', function () {
    setupToken();

    Http::fake([
        'https://api.kanye.rest' => Http::sequence()
            ->push(['quote' => 'quote 1'])
            ->push(['quote' => 'quote 2'])
            ->push(['quote' => 'quote 3'])
            ->push(['quote' => 'quote 4'])
            ->push(['quote' => 'quote 5'])
            ->push(['quote' => 'quote 6'])
            ->push(['quote' => 'quote 7'])
            ->push(['quote' => 'quote 8'])
            ->push(['quote' => 'quote 9'])
            ->push(['quote' => 'quote 10']),
    ]);

    $firstResponse = $this->get('/api/quotes?token=my-token');

    $firstResponse->assertStatus(200);

    expect($firstResponse->json())->toBe([
        'quote 1',
        'quote 2',
        'quote 3',
        'quote 4',
        'quote 5',
    ]);

    $freshResponse = $this->get('/api/fresh-quotes?token=my-token');

    $freshResponse->assertStatus(200);

    expect($freshResponse->json())->toBe([
        'quote 6',
        'quote 7',
        'quote 8',
        'quote 9',
        'quote 10',
    ]);
});

test('a user receives a cached response on the second visit when not refreshing', function () {
    setupToken();

    Http::fake([
        'https://api.kanye.rest' => Http::sequence()
            ->push(['quote' => 'quote 1'])
            ->push(['quote' => 'quote 2'])
            ->push(['quote' => 'quote 3'])
            ->push(['quote' => 'quote 4'])
            ->push(['quote' => 'quote 5'])
            ->push(['quote' => 'quote 6'])
            ->push(['quote' => 'quote 7'])
            ->push(['quote' => 'quote 8'])
            ->push(['quote' => 'quote 9'])
            ->push(['quote' => 'quote 10']),
    ]);

    $firstResponse = $this->get('/api/quotes?token=my-token');

    $firstResponse->assertStatus(200);

    expect($firstResponse->json())->toBe([
        'quote 1',
        'quote 2',
        'quote 3',
        'quote 4',
        'quote 5',
    ]);

    $freshResponse = $this->get('/api/quotes?token=my-token');

    $freshResponse->assertStatus(200);

    expect($freshResponse->json())->toBe([
        'quote 1',
        'quote 2',
        'quote 3',
        'quote 4',
        'quote 5',
    ]);
});
