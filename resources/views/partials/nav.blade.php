<nav class="flex justify-between items-center mb4">
    <h1 class="f4 fw4">
        <a class="link black" href="{{ route('home') }}">Micro-blog</a>
    </h1>
    <div>
        <a class="link dim dark-gray f5 dib mr3" href="{{ route('home') }}">Posts</a>
        @loggedIn
            <a class="link dim dark-gray f5 dib" href="{{ route('auth.logout') }}">Log out ({{ session('username') }})</a>
        @else
            <a class="link dim dark-gray f5 dib" href="{{ route('auth.login') }}">Log in</a>
        @endloggedIn
    </div>
</nav>