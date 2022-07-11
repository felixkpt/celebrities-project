@include('/templates/header')
<div class="flex flex-col items-center">
    <div class="w-full sm:max-w-md m-4 px-6 py-4 bg-white shadow-md overflow-hidden rounded-lg">
        <div class="mb-4 text-sm text-gray-600">
                {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
            </div>
            
            
            @include('/components/notifications/inline')
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div>
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <div class="flex justify-end mt-4">
                <x-button>
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
    </div>
</div>
@include('/templates/footer')
