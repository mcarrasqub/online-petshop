<?php
//edited by David Garcia Zapata
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CartRequest;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    public function index() : View
    {
        $viewData = [];
        $viewData['title'] = 'Cart - Online Petshop';
        $viewData['subtitle'] = 'Shopping Cart';
        $viewData['cart'] = Cart::getCart();
        $viewData['total'] = Cart::getTotal();
        
        return view('cart.index')->with('viewData', $viewData);
    }

    public function add(CartRequest $request, int $id) : RedirectResponse
    {
        $product = Product::findOrFail($id);
        Cart::add($product);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function remove(int $id) : RedirectResponse
    {
        Cart::remove($id);

        return redirect()->route('cart.index')->with('success', 'Product removed from cart!');
    }

    public function removeAll() : RedirectResponse
    {
        Cart::clear();

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }
}