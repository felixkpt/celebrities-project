@include('/templates/header')
<div class="flex flex-col w-full my-2">
    <div class="flex justify-center p-3">
        <div class="w-10/12 sm:w-8/12 md:w-7/12 lg:w-5/12 bg-white shadow-md rounded m-4 p-2">
            @include('/components/notifications/inline')
            <div class="flex w-full">
                <div id="account-chooser" class="w-full md:w-9/12 mx-auto">
                    <div>
                        <h2 class="text-center pb-3">Welcome back!</h2>
                    </div>
                    <div id="email-auth">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Email Address -->
                            <div class="mb-4">
                                <h5 class="text-center">{{ $email }}</h5>
                                <input type="hidden" name="email" value="{{ $email }}">
                            </div>
                            <div class="mb-4">
                                <input class="w-full" id="password" type="password" name="password" placeholder="Password" required="required" autocomplete="current-password">
                            </div>
                            <div class="mb-5 flex justify-between">
                                <label for="remember_me" class="flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                                </label>
                            </div>
                            <div class="mb-5">
                                <button type="submit" class="btn btn-success w-full">
                                    Login in
                                </button>
                            </div>
                            <div class="flex flex-col sm:flex-row w-full justify-between">
                                @if (Route::has('password.request'))
                                <a class="link-primary" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                                @endif
                                <a href="{{ route('login') }}" class="link-primary mt-4 sm:mt-0 border-t-2 sm:border-none">Not your account?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('/templates/footer')