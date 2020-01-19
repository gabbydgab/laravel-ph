@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white rounded shadow mt-10">
    <div class="max-w-sm mx-auto p-8">
        <form action="{{ route('register') }}" method="post">
            @csrf
            <h2 class="text-xl">Create Account</h2>
            <div class="mt-4">
                <input type="text" name="name" placeholder="Name" class="block w-full px-4 py-3 leading-tight appearance-none rounded shadow focus:outline-none focus:outline-shadow" />
                @error('name') <p class="mt-2 text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div class="mt-4">
                <input type="text" name="email" placeholder="Email" class="block w-full px-4 py-3 leading-tight appearance-none rounded shadow focus:outline-none focus:outline-shadow" />
                @error('email') <p class="mt-2 text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div class="mt-4">
                <input type="password" name="password" placeholder="******" class="block w-full px-4 py-3 leading-tight appearance-none rounded shadow focus:outline-none focus:outline-shadow" />
                @error('password') <p class="mt-2 text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div class="mt-4">
                <input type="password" name="password_confirmation" placeholder="******" class="block w-full px-4 py-3 leading-tight appearance-none rounded shadow focus:outline-none focus:outline-shadow" />
                @error('password') <p class="mt-2 text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div class="mt-8 text-right">
                <button class="h-10 px-4 bg-gray-600 rounded text-white">Register</button>
            </div>
        </form>
    </div>
</div>
<div class="mt-12 text-center">
    <a href="{{ route('login') }}">Already have an account? Log in.</a>
</div>
@endsection
