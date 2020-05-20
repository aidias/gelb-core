@extends('auth.layouts.auth')

@section('content')
    <section class="mt-24 mx-auto px-4">
        <h2 class="text-6xl text-center tracking-tight leading-10 font-extrabold text-gray-900">
            Password confirmation step.
        </h2>

        <h3 class="text-4xl text-center tracking-tight leading-10 text-gray-900 mt-8">
            {{ __('Please confirm your password before continuing.') }}
        </h3>

        <form class="mt-16 text-center" method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <fieldset class="mt-2">
                <input class="w-3/12 bg-gray-200 px-4 py-2 text-lg rounded-md @error('password') is-invalid @enderror"
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="current-password"
                    placeholder="password"
                    required
                >
                @error('password')
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
                    {{ __('Confirm Password') }}
                </button>
            </fieldset>

            <fieldset class="mt-6">
                @if (Route::has('password.request'))
                    <a
                        class="font-semibold text-yellow-700 hover:text-yellow-900"
                        href="{{ route('password.request') }}"
                    >
                        I forgot the password
                    </a>
                @endif
            </fieldset>
        </form>
    </section>
@endsection
