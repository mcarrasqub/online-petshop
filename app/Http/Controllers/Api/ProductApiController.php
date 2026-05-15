<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductApiController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::all();
        $data = [];

        foreach ($products as $product) {
            $data[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
                'price' => $product->getPrice(),
                'specie' => $product->getSpecie(),
                'image' => $product->getImageUrl(),
                'url' => route('product.show', ['id' => $product->getId()]),
            ];
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Products retrieved successfully',
            'data' => $data,
        ], 200);
    }
}
