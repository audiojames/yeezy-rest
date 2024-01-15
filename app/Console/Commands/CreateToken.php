<?php

namespace App\Console\Commands;

use App\Models\ApiToken;
use Illuminate\Console\Command;

class CreateToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new api token to the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $apiToken = ApiToken::create(['token' => \Str::uuid()]);

        $this->line("Your API Token is: {$apiToken->token}");

        return Command::SUCCESS;
    }
}
