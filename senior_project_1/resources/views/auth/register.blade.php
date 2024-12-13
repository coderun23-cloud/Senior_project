<x-guest-layout>
    <x-authentication-card class="bg-white p-8 rounded-xl shadow-lg max-w-md mx-auto">
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4 text-red-600" />

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- Name Field -->
            <div class="mb-6">
                <x-label for="name" value="{{ __('Name') }}" class="text-lg font-semibold text-gray-700" />
                <x-input id="name" class="block mt-2 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <!-- Email Field -->
            <div class="mb-6">
                <x-label for="email" value="{{ __('Email') }}" class="text-lg font-semibold text-gray-700" />
                <x-input id="email" class="block mt-2 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <!-- Password Field -->
            <div class="mb-6">
                <x-label for="password" value="{{ __('Password') }}" class="text-lg font-semibold text-gray-700" />
                <x-input id="password" class="block mt-2 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Password Confirmation Field -->
            <div class="mb-6">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-lg font-semibold text-gray-700" />
                <x-input id="password_confirmation" class="block mt-2 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <!-- Address Field -->
            <div class="mb-6">
                <x-label for="address" value="{{ __('Address') }}" class="text-lg font-semibold text-gray-700" />
                <x-input id="address" class="block mt-2 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="text" name="address" :value="old('address')" />
            </div>

            <!-- Phone Number Field -->
            <div class="mb-6">
                <x-label for="phone_number" value="{{ __('Phone Number') }}" class="text-lg font-semibold text-gray-700" />
                <x-input id="phone_number" class="block mt-2 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="text" name="phone_number" :value="old('phone_number')" />
            </div>

            <!-- Profile Picture Field -->
            <div class="mb-6">
                <x-label for="profile_picture" value="{{ __('Profile Picture') }}" class="text-lg font-semibold text-gray-700" />
                <x-input id="profile_picture" class="block mt-2 w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" type="file" name="profile_picture" accept="image/*" />
            </div>

            <!-- Terms and Privacy Policy -->
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mb-6">
                    <x-label for="terms" class="text-sm text-gray-600">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />
                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!} 
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <!-- Buttons -->
            <div class="flex items-center justify-between mt-8">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="bg-indigo-600 hover:bg-indigo-700 text-white rounded-md px-6 py-2 transition duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
