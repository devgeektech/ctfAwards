<x-guest-layout>
    <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
        <div class="card card-plain">
            <div class="card-header pb-0 text-start">
                <h4 class="font-weight-bolder">Sign Up</h4>
                <p class="mb-0">Create Your New Account Credentials</p>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-4">
                        {{-- <x-input-label for="name" :value="__('Name')" /> --}}
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :placeholder="__('Name')" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        {{-- <x-input-label for="email" :value="__('Email')" /> --}}
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :placeholder="__('Email')" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        {{-- <x-input-label for="password" :value="__('Password')" /> --}}

                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                            :placeholder="__('Password')" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        {{-- <x-input-label for="password_confirmation" :value="__('Enter confirm password')" /> --}}

                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password" :placeholder="__('Confirm Password')" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end">
                        <x-primary-button>
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                        <p class="mt-4 text-sm mx-auto">
                            Already have an account?
                            <a href="{{ route('login') }}" class="text-primary text-gradient font-weight-bold">
                                {{ __('Sign in') }}</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
