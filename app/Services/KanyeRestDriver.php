<?php

namespace App\Services;

use Illuminate\Support\Collection;

class KanyeRestDriver
{
    public function getFiveQuotes(): Collection
    {
        return \Cache::remember('five-quotes', 10, function () {
            return Collection::times(5, function () {
                $response = \Http::get('https://api.kanye.rest');

                if ($response->failed()) {
                    return 'Quote Unavailable';
                }

                return $response->json('quote');
            });
        });

    }

    public function getFiveFreshQuotes(): Collection
    {
        \Cache::forget('five-quotes');

        return $this->getFiveQuotes();
    }
}
