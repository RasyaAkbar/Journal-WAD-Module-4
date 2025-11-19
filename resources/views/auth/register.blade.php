@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="w-100" style="max-width: 420px;">
        <div class="card border-0 shadow-lg">
            <div class="card-body p-5">
                <h2 class="card-title h3 fw-bold text-center mb-1">Create Account</h2>
                <p class="text-center text-muted mb-5 fs-6">Join our library community</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label fw-500">Full Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="form-control form-control-lg @error('name') is-invalid @enderror"
                            placeholder="Enter your full name">
                        @error('name')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label fw-500">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                            placeholder="Enter your email">
                        @error('email')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-500">Password</label>
                        <input id="password" type="password" name="password" required
                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                            placeholder="Create a strong password">
                        @error('password')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password-confirm" class="form-label fw-500">Confirm Password</label>
                        <input id="password-confirm" type="password" name="password_confirmation" required
                            class="form-control form-control-lg"
                            placeholder="Confirm your password">
                    </div>

                    <div class="d-grid gap-2 mb-3">
                        <button type="submit" class="btn btn-primary btn-lg fw-semibold">
                            Create Account
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="text-muted">Already have an account? <a href="{{ route('login') }}" class="text-decoration-none fw-semibold">Sign in here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection