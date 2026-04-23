<div class="navbar bg-base-100 shadow-sm">
    <div class="navbar-start">
        <div class="dropdown">
            <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                </svg>
            </div>
            <ul tabindex="-1" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                <ul class="p-2">
                    <li><a href="/">Home</a></li>
                    <li><a>Submenu 2</a></li>
                </ul>
                </li>
                <li><a>Item 3</a></li>
            </ul>
        </div>
        <a href="/home" class="btn btn-ghost text-xl">
            <img src="{{ asset('storage/bondhub.jpeg') }}" alt="User Image" style="height: 30px" width="105px">
        </a>
    </div>
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <li><a href="/home">Home</a></li>
            <li><a href="{{ route('profile.show') }}">Profile</a></li>

            @if (auth()->check() && auth()->user()->is_admin)
                <li><a href="/draw">Admin</a></li>
            @endif
        </ul>
    </div>
    <div class="navbar-end">
        @guest
            <a href="/login" class="btn btn-ghost">Login</a>
            <a href="/register" class="btn">Register</a>
        @endguest
        @auth
            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="btn btn-outline btn-error">Logout</button>
            </form>
        @endauth
    </div>
</div>