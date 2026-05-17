<?php

// edited by David Garcia Zapata

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Services\CartService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(private readonly CartService $cartService) {}

    public function index(Request $request): View
    {
        $viewData = [];
        $viewData['title'] = __('cart.title_index');
        $viewData['subtitle'] = __('cart.subtitle_index');
        $viewData['cart'] = $this->cartService->getCart($request);
        $viewData['total'] = $this->cartService->calculateTotal($request);

        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(CartRequest $request, int $id): RedirectResponse
    {
        $this->cartService->add($request, $id);

        return redirect()->back()->with('success', __('cart.messages.added'));
    }

    public function decrease(CartRequest $request, int $id): RedirectResponse
    {
        $this->cartService->decrease($request, $id);

        return redirect()->back()->with('success', __('cart.messages.decreased'));
    }

    public function remove(Request $request, int $id): RedirectResponse
    {
        $this->cartService->remove($request, $id);

        return redirect()->route('cart.index')->with('success', __('cart.messages.removed'));
    }

    public function removeAll(Request $request): RedirectResponse
    {
        $this->cartService->removeAll($request);

        return redirect()->route('cart.index')->with('success', __('cart.messages.cleared'));
    }
}
