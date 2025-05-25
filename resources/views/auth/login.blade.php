@extends('layouts.app')

@section('content')
<div class="container" dir="rtl">
    <style>
        /* General RTL Support */
        [dir="rtl"] {
            text-align: right;
        }

        /* Ensure form elements and labels are right-aligned */
        .form-control,
        .col-form-label {
            text-align: right;
        }

        .card-header {
            text-align: right;
        }

        .row {
            direction: rtl;
        }

        .btn-center {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .invalid-feedback {
            color: #dc3545; /* Bootstrap's red color for invalid feedback */
        }

        .form-check {
            display: flex;
            align-items: center;
        }

        .form-check-input {
            margin-left: 0.5rem; /* Space between checkbox and label */
        }

        .form-check-label {
            margin-bottom: 0; /* Ensure no extra space below the label */
        }

        .form-group {
            margin-bottom: 1rem; /* Adjust spacing for form groups */
        }

        .forgot-password-link {
            font-size: 0.9rem; /* Adjust font size for better fit */
            text-align: center; /* Center the forgot password link */
            display: block;
            margin-top: 1rem; /* Add space above the link */
        }

        .login-button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('تسجيل الدخول') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('البريد الإلكتروني') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('كلمة المرور') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="form-group row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('تذكرني') }}
                                    </label>
                                </div>
                            </div>
                        </div> --}}

                        <div class="login-button-container">
                            <button type="submit" class="btn btn-primary">
                                {{ __('تسجيل الدخول') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link forgot-password-link" href="{{ route('password.request') }}">
                                    {{ __('هل نسيت كلمة المرور؟') }}
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
