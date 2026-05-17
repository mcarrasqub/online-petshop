<?php

// Edited by Sofia Gallo

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     */
    public function showRegistrationForm(): View
    {
        $viewData = [];
        $viewData['title'] = __('ui.register');
        $viewData['nameLabel'] = __('ui.name');
        $viewData['phoneLabel'] = __('ui.phone_number');
        $viewData['emailLabel'] = __('ui.email_address');
        $viewData['passwordLabel'] = __('ui.password');
        $viewData['confirmPasswordLabel'] = __('ui.confirm_password');
        $viewData['buttonText'] = __('ui.register');

        return view('auth.register')->with('viewData', $viewData);
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        event(new Registered($user = $this->create($validated)));

        $this->guard()->login($user);

        return redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
