<?php

it('calls the correct url', function () {
    Http::fake();

    $driver = new \App\Services\KanyeRestDriver();

    $driver->getFiveQuotes();

    Http::assertSent(function (\Illuminate\Http\Client\Request $request) {
        return $request->url() === 'https://api.kanye.rest';
    });
});

it('calls the API 5 times', function () {
    Http::fake();

    $driver = new \App\Services\KanyeRestDriver();

    $driver->getFiveQuotes();

    Http::assertSentCount(5);
});

it('does not call the api on subsequent calls', function () {
    $driver = new \App\Services\KanyeRestDriver();

    $driver->getFiveQuotes();

    Http::fake();

    $driver->getFiveQuotes();

    $driver->getFiveQuotes();

    Http::assertNothingSent();
});

it('returns a string if there is an error', function () {
    Http::fake([
        'https://api.kanye.rest' => Http::sequence()
            ->push(['quote' => 'quote 1'])
            ->pushStatus(403)
            ->pushStatus(500)
            ->push(['quote' => 'quote 4'])
            ->push(['quote' => 'quote 5']),
    ]);

    $driver = new \App\Services\KanyeRestDriver();

    expect($driver->getFiveQuotes()->toArray())->toBe([
        'quote 1',
        'Quote Unavailable',
        'Quote Unavailable',
        'quote 4',
        'quote 5',
    ]);
});

it('calls the cache when called', function () {
    Cache::shouldReceive('remember')
        ->once()
        ->andReturn(collect());

    $driver = new \App\Services\KanyeRestDriver();

    $driver->getFiveQuotes();
});

it('calls cache forget to get fresh quotes', function () {
    Cache::shouldReceive('forget')
        ->once()
        ->with('five-quotes');

    Cache::shouldReceive('remember')->andReturn(collect());

    $driver = new \App\Services\KanyeRestDriver();

    $driver->getFiveFreshQuotes();
});
