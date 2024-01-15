<?php

it('returns the correct default driver', function () {
    $driver = app(\App\Services\KanyesManager::class)->getDefaultDriver();

    expect($driver)->toBe('kanye-rest');
});

it('returns the correct driver class', function () {
    $driver = app(\App\Services\KanyesManager::class)->driver();

    expect($driver)->toBeInstanceOf(\App\Services\KanyeRestDriver::class);

});
