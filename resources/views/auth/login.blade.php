@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white rounded shadow mt-10">
    <div class="max-w-sm mx-auto p-8">
        <form action="{{ route('login') }}" method="post">
            @csrf
            <h2 class="text-xl">Login</h2>
            <div class="mt-4">
                <input type="text" name="email" placeholder="Email" class="block w-full px-4 py-3 leading-tight appearance-none rounded shadow focus:outline-none focus:outline-shadow" />
                @error('email') <p class="mt-2 text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div class="mt-4">
                <input type="password" name="password" placeholder="******" class="block w-full px-4 py-3 leading-tight appearance-none rounded shadow focus:outline-none focus:outline-shadow" />
                @error('password') <p class="mt-2 text-red-500 text-sm">{{ $message }}</p> @enderror
            </div>
            <div class="flex justify-between mt-4">
                <div>
                    <input type="checkbox" name="remember" id="inputRemember">
                    <label for="inputRemember">Remember me</label>
                </div>
                <div>
                    <a href="{{ route('password.request') }}">Forgot?</a>
                </div>
            </div>
            <div class="mt-8 text-right">
                <button class="h-10 px-4 bg-gray-600 rounded text-white">Log In</button>
            </div>
        </form>
    </div>
</div>
@endsection
