<nav class="mt-0 " style="display: flex; flex-direction: row; justify-content: space-between ; border: 1px solid black;">
    <div class="leftbar" style="display: flex;">
        <div class="image">
            <img src="#">
        </div>
        <p class="col-end-13">The games corner</p>
    </div>

    <div class="middlebar">
        <x-link href="/" :active="!request()->is('/')">Home</x-link>
        <x-link href="/games" :active="!request()->is('games')">Games</x-link>
    </div>

    <div class="rightbar">
        <x-link href="/profile" :active="!request()->is('profile')">Profile</x-link>
        <div class="avatar">
            <img src="#">
        </div>
    </div>
</nav>

