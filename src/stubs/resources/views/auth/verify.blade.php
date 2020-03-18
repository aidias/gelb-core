@extends('auth.layouts.auth')

@section('content')
    <section class="mt-24 mx-auto px-4">
        <h2 class="text-6xl text-center tracking-tight leading-10 font-extrabold text-gray-900">
            {{ __('Verify Your Email Address') }}
        </h2>

        <h3 class="text-4xl text-center tracking-tight leading-10 text-gray-900 mt-8">
            {{ __('Before proceeding, please check your email for a verification link.') }}
        </h3>

        @if (session('resent'))
            <h6 class="font-light text-blue-500 text-center mt-8" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </h6>
        @endif

        <h4 class="text-2xl text-center tracking-tight leading-10 text-gray-900 mt-16">
            {{ __('If you did not receive the email') }},
        </h4>
        <form class="text-center" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button
                type="submit"
                class="w-3/12 px-4 py-2 bg-gray-600 text-white text-lg font-semibold rounded-md hover:bg-gray-700"
            >
                {{ __('click here to request another') }}
            </button>
        </form>
    </section>
@endsection
