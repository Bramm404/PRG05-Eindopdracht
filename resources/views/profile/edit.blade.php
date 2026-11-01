<x-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            Profiel
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl bg-white shadow-xl ring-1 ring-black-100">
                <div class="p-6 sm:p-10">
                    @include('profile.partials.update-profile-information-form')
                </div>
                <div class="border-t-2 border-black-200 p-6 sm:p-10">
                    @include('profile.partials.update-password-form')
                </div>
                <div class="border-t-2 border-black-200 p-6 sm:p-10">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-layout>
