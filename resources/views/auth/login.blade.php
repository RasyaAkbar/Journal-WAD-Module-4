@extends('layouts.app')

@section('content')
@if(session('error') || session('success'))
    @php
        $type = session('error') ? 'error' : 'success';
        $message = session($type);
        $alertClass = $type === 'error' ? 'alert-danger' : 'alert-success';
        $id = $type . 'Message';
    @endphp

    <div id="{{ $id }}" class="alert {{ $alertClass }} alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        setTimeout(function() {
            var el = document.getElementById('{{ $id }}');
            if (el) {
                var alert = new bootstrap.Alert(el);
                alert.close();
            }
        }, 5000);
    </script>
@endif

<div class="d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="w-100" style="max-width: 420px;">
        <div class="card border-0 shadow-lg">
            <div class="card-body p-5">
                <h2 class="card-title h3 fw-bold text-center mb-1">Welcome Back</h2>
                <p class="text-center text-muted mb-5 fs-6">Sign in to your account</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label fw-500">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                            placeholder="Enter your email">
                        @error('email')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-500">Password</label>
                        <input id="password" type="password" name="password" required
                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                            placeholder="Enter your password">
                        @error('password')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}
                                class="form-check-input">
                            <label for="remember" class="form-check-label">Remember me</label>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mb-3">
                        <button type="submit" class="btn btn-primary btn-lg fw-semibold">
                            Sign In
                        </button>
                    </div>

                    <div class="text-center">
                        <p class="text-muted">Don't have an account? <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Sign up here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection