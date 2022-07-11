@include('/templates/header')
<div class="flex flex-col w-full my-2">
    <div class="flex justify-center p-3">
        <div class="w-10/12 sm:w-8/12 md:w-7/12 lg:w-5/12 bg-white shadow-md rounded m-4 p-2">
            @include('/components/notifications/inline')
            <div class="flex w-full">
                <div id="account-chooser" class="w-full md:w-10/12 mx-auto">
                    <div>
                        <h2 class="text-center pb-3">Forgot your password</h2>
                    </div>
                    <div class="mb-4">
                        <p>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
                    </div>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <!-- Email Address -->
                        <div class="mb-4">
                            <input class="w-full" id="email" type="email" name="email" value="{{ old('email') ?? $email }}" required="required" autofocus="autofocus" placeholder="Enter email">
                        </div>
                        <div class="mt-8 flex items-center justify-center">
                            <button type="submit" class="btn btn-outline-success">
                                Email Password Reset Link
                            </button>
                        </div>
                        <div class="w-full mt-4 border-t-2">
                            <a href="{{ route('login') }}" class="link-primary mt-4">Not your account?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('/templates/footer')