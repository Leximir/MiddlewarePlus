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
    protected $signature = 'app:test-command {city}';

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
        $response = Http::get(env('WEATHER_API_URL').'/v1/forecast.json', [
            'key' => env('WEATHER_API_KEY'),
            'q' => $this->argument('city'),
            'aqi' => 'no',
            'days' => 1
        ]);

        $jsonResponse = $response->json();

        if(isset($jsonResponse['error'])){
            $this->output->error($jsonResponse['error']['message']);
            exit();
        }

        dd($jsonResponse);

    }
}
