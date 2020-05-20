@extends('auth.layouts.auth')

@section('content')
    <section class="mt-24 mx-auto px-4">
        <h2 class="text-6xl text-center tracking-tight leading-10 font-extrabold text-gray-900">
            Did you forget your password?
        </h2>

        <h3 class="text-4xl text-center tracking-tight leading-10 text-gray-900 mt-8">
            Type your email and we will send you a reset message.
        </h3>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form class="mt-16 text-center" method="POST" action="{{ route('password.email') }}">
            @csrf

            <fieldset class="mt-2">
                <input class="w-3/12 bg-gray-200 px-4 py-2 text-lg rounded-md @error('email') is-invalid @enderror"
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    placeholder="email"
                    required  autofocus
                >
                @error('email')
                    <span class="block text-sm font-light text-red-500" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </fieldset>

            <fieldset class="mt-4">
                <button
                    class="w-3/12 px-4 py-2 bg-gray-600 text-white text-lg font-semibold rounded-md hover:bg-gray-700"
                    type="submit"
                >
                {{ __('Send Password Reset Link') }}
                </button>
            </fieldset>
        </form>

        <nav class="mt-16 w-4/12 mx-auto flex items-center justify-between">
            <a href="/" title="Home" class="flex text-gray-600 hover:text-gray-700">Home</a>
            <a href="{{ route('login') }}" title="Login" class="flex text-gray-600 hover:text-gray-700">Login</a>
            <a href="https://github.com/aidias/gelb-core/blob/master/LICENSE.md" title="Terms of use" class="flex text-gray-600 hover:text-gray-700">Terms</a>
        </nav>
    </section>
@endsection
