<?php

// Edited by Sofia Gallo

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Show the email verification prompt.
     */
    public function show(Request $request): RedirectResponse|View
    {
        return $request->user()->hasVerifiedEmail()
                    ? redirect($this->redirectPath())
                    : view('auth.verify')->with('viewData', [
                        'title' => __('ui.verify_your_email_address'),
                        'successMessage' => __('ui.fresh_verification_link_sent'),
                        'instructionText' => __('ui.before_proceeding_check_email'),
                        'requestAnotherText' => __('ui.if_you_did_not_receive_email'),
                        'buttonText' => __('ui.click_here_request_another'),
                    ]);
    }
}
