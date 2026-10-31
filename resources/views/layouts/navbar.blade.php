<nav
    class="site-navbar flex flex-row items-center justify-between gap-6 border-b border-slate-200 bg-white px-4 py-3 shadow-sm sm:px-6">
    <div class="flex min-w-0 flex-1 flex-row items-center gap-3">
        <div
            class="logo-slot flex h-10 w-10 shrink-0 items-center justify-center overflow-hidden rounded-full bg-slate-100">
            <img src="#" alt="The Games Corner logo" class="h-full w-full object-cover">
        </div>
        <a href="/" class="truncate text-lg font-bold text-slate-900">
            The Games Corner
        </a>
    </div>

    <div class="flex shrink-0 flex-row items-center justify-center gap-1 sm:gap-3">
        <x-link
            href="/dashboard" :active="!request()->is('/dashboard*')"
            class="navbar-link rounded-md px-3 py-2 text-sm font-medium"
        >
            Home
        </x-link>
        <x-link
            href="/games" :active="!request()->is('games*')"
            class="navbar-link rounded-md px-3 py-2 text-sm font-medium"
        >
            Games
        </x-link>
    </div>

    <div class="flex min-w-0 flex-1 flex-row items-center justify-end gap-3">

        <div class="flex min-w-0 flex-1 flex-row items-center justify-end gap-3">
            @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            type="button"
                            class="navbar-link inline-flex items-center gap-2 rounded-md px-3 py-2 text-sm font-medium"
                        >
                            <span>Profile</span>

                            <svg
                                class="h-4 w-4 fill-current"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"
                                />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link
                                :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                            >
                                Log out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

                <div class="profile-slot flex h-9 w-9 shrink-0 items-center justify-center overflow-hidden rounded-full bg-slate-200">
                    @if(auth()->user()->avatar)
                        <img src="{{ asset('storage/'.auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}" class="h-full w-full object-cover">
                    @else
                        <span class="font-semibold text-slate-600">{{ str(auth()->user()->name)->substr(0, 1)->upper() }}</span>
                    @endif
                </div>
            @else
                <a href="{{ route('login') }}" class="navbar-link rounded-md px-3 py-2 text-sm font-medium">
                    Log in
                </a>
            @endauth
        </div>

    </div>
</nav>
