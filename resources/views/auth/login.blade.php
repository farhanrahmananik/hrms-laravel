@extends('layouts.guest')

@section('title', 'Login')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <h1 class="h3 mb-2 text-center">Sign in</h1>
                    <p class="mb-4 text-center text-body-secondary">Access your HRMS dashboard.</p>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            Please check the form and try again.
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/login') }}" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror"
                                autocomplete="username"
                                autofocus
                                required
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                autocomplete="current-password"
                                required
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4 form-check">
                            <input
                                id="remember"
                                type="checkbox"
                                name="remember"
                                value="1"
                                class="form-check-input @error('remember') is-invalid @enderror"
                                @checked(old('remember'))
                            >
                            <label class="form-check-label" for="remember">Remember me</label>
                            @error('remember')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
