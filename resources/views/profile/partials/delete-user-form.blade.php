<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-black">
            Account verwijderen
        </h2>

        <p class="mt-1 text-sm text-black">
            Zodra je account is verwijderd, worden al je gegevens definitief verwijderd. Download eerst alle gegevens
            die je wilt bewaren.
        </p>
    </header>

    <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">Account
        verwijderen</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-black">
                Weet je zeker dat je je account wilt verwijderen?
            </h2>

            <p class="mt-1 text-sm text-black">
                Deze actie kan niet ongedaan worden gemaakt. Voer je wachtwoord in om het verwijderen te bevestigen.
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="Wachtwoord" class="sr-only" />

                <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4"
                    placeholder="Wachtwoord" />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Annuleren
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    Account verwijderen
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
