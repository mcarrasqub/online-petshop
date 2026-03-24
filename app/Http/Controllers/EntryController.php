<?php

// Edited by Sofia Gallo

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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
