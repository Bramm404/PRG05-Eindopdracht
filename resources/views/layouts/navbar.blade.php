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
        <x-link
            href="/profile"
            :active="!request()->is('profile*')"
            class="navbar-link rounded-md px-3 py-2 text-sm font-medium"
        >
            Profile
        </x-link>
        <div
            class="profile-slot flex h-9 w-9 shrink-0 items-center justify-center overflow-hidden rounded-full bg-slate-200">
            <img src="#" alt="Profile avatar" class="h-full w-full object-cover">
        </div>
    </div>
</nav>
