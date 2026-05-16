<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ExchangeRateService
{
    public function convertCopToUsd(float $copPrice): float
    {
        $rate = $this->getUsdToCopRate();

        if ($rate <= 0) {
            return 0;
        }

        return round($copPrice / $rate, 2);
    }

    private function getUsdToCopRate(): float
    {
        return Cache::remember('usd_to_cop_rate', 3600, function () {
            try {
                $apiUrl = 'https://open.er-api.com/v6/latest/USD';

                $response = Http::get($apiUrl);

                if ($response->successful()) {
                    $data = $response->json();
                    return (float) ($data['rates']['COP'] ?? 4000.0);
                }
            } catch (\Exception $e) {
                Log::error('Error fetching exchange rate: ' . $e->getMessage());
            }

            return 4000.0;
        });
    }
}
