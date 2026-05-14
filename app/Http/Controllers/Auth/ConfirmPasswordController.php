<?php

// Edited by Sofia Gallo

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the password confirmation view.
     */
    public function showConfirmForm(): View
    {
        $viewData = [];
        $viewData['title'] = __('ui.confirm_password');
        $viewData['subtitle'] = __('ui.please_confirm_password_before_continuing');
        $viewData['forgotPasswordRoute'] = Route::has('password.request') ? route('password.request') : null;

        return view('auth.passwords.confirm')->with('viewData', $viewData);
    }
}
