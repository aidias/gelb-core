@extends('auth.layouts.auth')

@section('content')
    <section class="mt-24 mx-auto px-4">
        <h3 class="text-4xl text-center tracking-tight leading-10 text-gray-900 mt-8">
            Register yourself to get access to the private area.
        </h3>

        <form class="mt-16 text-center" method="POST" action="{{ route('register') }}">
            @csrf

            <fieldset class="mt-2">
                <input class="w-3/12 bg-gray-200 px-4 py-2 text-lg rounded-md @error('name') is-invalid @enderror"
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    autocomplete="name"
                    placeholder="name"
                    required  autofocus
                >
                @error('name')
                    <span class="block text-sm font-light text-red-500" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </fieldset>

            <fieldset class="mt-2">
                <input class="w-3/12 bg-gray-200 px-4 py-2 text-lg rounded-md @error('email') is-invalid @enderror"
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    placeholder="email"
                    required
                >
                @error('email')
                    <span class="block text-sm font-light text-red-500" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </fieldset>

            <fieldset class="mt-2">
                <input class="w-3/12 bg-gray-200 px-4 py-2 text-lg rounded-md @error('password') is-invalid @enderror"
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                    placeholder="password"
                    required
                >
                @error('password')
                    <span class="block text-sm font-light text-red-500" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </fieldset>

            <fieldset class="mt-2">
                <input class="w-3/12 bg-gray-200 px-4 py-2 text-lg rounded-md @error('password') is-invalid @enderror"
                    id="password-confirm"
                    name="password_confirmation"
                    type="password"
                    autocomplete="new-password"
                    placeholder="confirm the password"
                    required
                >
            </fieldset>

            <fieldset class="mt-4">
                <button
                    class="w-3/12 px-4 py-2 bg-gray-600 text-white text-lg font-semibold rounded-md hover:bg-gray-700"
                    type="submit"
                >
                    {{ __('Register') }}
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
