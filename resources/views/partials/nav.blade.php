<nav class="h-16 bg-gray-800 flex items-center">
    <div class="w-full max-w-5xl mx-auto flex items-center justify-between px-4">
        <div class="flex items-center">
            <a class="text-white font-semibold" href="{{ url('/') }}">{{ config('app.name', 'Laravel Philippines') }}</a>
            <a class="text-white px-2 ml-4" href="{{ route('articles.index') }}">Articles</a>
        </div>
        <div class="flex items-center -mx-2">
            @guest
                <a class="text-white px-2" href="{{ route('login') }}">Login</a>
                <a class="text-white px-2" href="{{ route('register') }}">Register</a>
            @else
                <a class="text-white px-2" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endguest
        </div>
    </div>
</nav>
