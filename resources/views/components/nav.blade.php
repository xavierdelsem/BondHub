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
            <span class="text-primary">{{ auth()->user()->name }}</span>
            <div class="dropdown dropdown-end mx-2">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                    <div class="indicator">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                            </path>
                        </svg>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                            <span class="badge badge-sm badge-error indicator-item">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        @endif
                    </div>
                </div>
                <div tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-80">
                    <div
                        class="px-4 py-2 font-bold border-b border-base-300 flex justify-between items-center border-b-cyan-500">
                        <span>Notifications</span>
                        @if(auth()->user()->unreadNotifications->isNotEmpty())
                            <form action="{{ route('notifications.markAllAsRead') }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-xs text-primary hover:underline">Mark All as Read</button>
                            </form>
                        @endif
                    </div>
                    <div class="max-h-64 overflow-y-auto bg-blue-950">
                        @forelse(auth()->user()->unreadNotifications as $notification)
                            <li class="flex flex-row items-center gap-1">
                                <span
                                    class="flex-1 py-2 px-4 text-sm leading-tight">{{ $notification->data['message'] ?? 'New prize bond update' }}</span>
                                <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST"
                                    class="pr-2">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-ghost btn-xs btn-circle text-success"
                                        title="Mark as read">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7" />
                                        </svg>
                                    </button>
                                </form>
                            </li>
                        @empty
                            <li><span class="px-4 py-4 italic opacity-50 text-xs text-center">No new notifications</span></li>
                        @endforelse
                    </div>
                </div>
            </div>

            <form method="POST" action="/logout">
                @csrf
                <button type="submit" class="btn btn-outline btn-error">Logout</button>
            </form>
        @endauth
    </div>
</div>