<?php

// Edited by Mariana Carrasquilla Botero

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class EntryController extends Controller
{

    public function root(): RedirectResponse
    {
        if (Auth::check()) {
            return $this->redirectByRole();
        }

        return redirect()->route('login');
    }

    public function home(): RedirectResponse
    {
        return $this->redirectByRole();
    }

    private function redirectByRole(): RedirectResponse
    {
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.home.index');
        }

        return redirect()->route('product.index');
    }
}
