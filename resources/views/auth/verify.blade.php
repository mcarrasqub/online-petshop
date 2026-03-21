@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ui.verify_your_email_address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('ui.fresh_verification_link_sent') }}
                        </div>
                    @endif

                    {{ __('ui.before_proceeding_check_email') }}
                    {{ __('ui.if_you_did_not_receive_email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('ui.click_here_request_another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
