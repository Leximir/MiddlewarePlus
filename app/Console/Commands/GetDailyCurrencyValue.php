<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetDailyCurrencyValue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-daily-currency-value';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get todays currency values for USD and EUR';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currencies = ['usd', 'eur'];

        foreach ($currencies as $currency){
            $response = Http::get("https://kurs.resenje.org/api/v1/currencies/$currency/rates/today");
            var_dump($response->json()['exchange_middle']);
        }


    }
}
