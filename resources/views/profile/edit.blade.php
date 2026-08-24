<x-layouts.app title="Perfil — CentinelaOps">
    <h1 class="font-display text-2xl font-semibold mb-6">{{ __('Profile') }}</h1>

    <div class="max-w-xl space-y-6">
        <div class="p-6 bg-centinela-superficie rounded-md">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="p-6 bg-centinela-superficie rounded-md">
            @include('profile.partials.update-password-form')
        </div>

        <div class="p-6 bg-centinela-superficie rounded-md border border-estado-caido/20">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-layouts.app>