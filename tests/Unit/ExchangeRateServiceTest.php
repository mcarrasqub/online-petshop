<?php

namespace Tests\Unit;

use App\Services\ExchangeRateService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExchangeRateServiceTest extends TestCase
{
    public function test_exchange_rate_service_converts_correctly_with_mocked_api(): void
    {
        Http::fake([
            'https://open.er-api.com/*' => Http::response([
                'rates' => [
                    'COP' => 4000.0,
                ],
            ], 200),
        ]);

        Cache::forget('usd_to_cop_rate');

        $service = new ExchangeRateService;
        $result = $service->convertCopToUsd(12000.0);

        $this->assertEquals(3.00, $result);
    }

    public function test_exchange_rate_service_uses_fallback_on_api_failure(): void
    {
        Http::fake([
            'https://open.er-api.com/*' => Http::response(null, 500),
        ]);

        Cache::forget('usd_to_cop_rate');

        $service = new ExchangeRateService;
        $result = $service->convertCopToUsd(12000.0);

        $this->assertEquals(3.00, $result);
    }
}
