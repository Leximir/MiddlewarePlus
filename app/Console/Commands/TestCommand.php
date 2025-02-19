<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $response = Http::get('https://api.weatherapi.com/v1/current.json', [
            'key' => 'b6874aea855542958f4191441251902',
            'q' => 'London',
            'aqi' => 'no'
        ]);
        dd($response->json());
    }
}
