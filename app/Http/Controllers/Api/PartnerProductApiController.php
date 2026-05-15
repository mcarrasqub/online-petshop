<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class PartnerProductApiController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['title'] = __('partner.title');
        $viewData['subtitle'] = __('partner.subtitle');

        $response = Http::get('http://34.63.29.192/api/products');
        
        $viewData['products'] = [];
        $viewData['storeName'] = __('partner.default_store');

        if ($response->successful()) {
            $data = $response->json();
            $viewData['products'] = $data['data'] ?? [];
            $viewData['storeName'] = $data['additionalData']['storeName'] ?? __('partner.default_store');
        }

        return view('partner-product.index')->with('viewData', $viewData);
    }
}
