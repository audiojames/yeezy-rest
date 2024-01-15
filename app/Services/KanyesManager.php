<?php

namespace App\Services;

use Illuminate\Support\Manager;

class KanyesManager extends Manager
{
    public function getDefaultDriver(): string
    {
        return 'kanye-rest';
    }

    public function createKanyeRestDriver(): KanyeRestDriver
    {
        return new KanyeRestDriver();
    }
}
