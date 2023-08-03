@extends('layouts.auth')

@section('title', 'Login')

@section('content')

    <div class="login-signup-form animated fadeInDown">
        <div class="form">
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1 class="title">LOGIN</h1>
                <input type="email"id="email" name="email" placeholder="Email" value="{{ old('email') }}" required
                    autofocus />
                <input type="password" id="password" name="password" placeholder="Password" required />
                @if ($errors->has('email'))
                    <p class="text-red-500 mb-3 text-sm">{{ $errors->first('email') }}</p>
                @endif
                <button class="btn btn-block">Login</button>
            </form>
        </div>
    </div>

@endsection
