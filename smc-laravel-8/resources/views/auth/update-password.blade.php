<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a account password has expired. Please update your password before continuing.') }}
        </div>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <x-label for="current_password" :value="__('Current Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

                <!-- New Password -->
                <div>
                    <x-label for="new_password" :value="__('New Password')" />

                    <x-input id="new_password" class="block mt-1 w-full"
                             type="password"
                             name="new_password"
                             required  />
                </div>

                <!-- Confirm New Password -->
                <div>
                    <x-label for="confirm_password" :value="__('Confirm Password')" />

                    <x-input id="confirm_password" class="block mt-1 w-full"
                             type="password"
                             name="confirm_password"
                             required  />
                </div>

            <div class="flex justify-end mt-4">
                <x-button>
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
