
<x-dashboard-layout>

    @if (Route::currentRouteName()=='role.create')
    <h1 class=" text-start text-5xl m-3">Create Role</h1>
    @else
    <h1 class=" text-start text-5xl m-3">Create Permission</h1>  
    @endif

    <div class=" max-w-lg mx-auto bg-white m-6 p-12 rounded-lg">
        <form method="POST" action="<?php if(Route::currentRouteName()=='role.create') echo route('role.store'); else echo route('Permission.store');?>">
            @csrf
    
            <!-- Email Address -->
            {{-- <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div> --}}
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="name" :value="__('name')" />
    
                <x-text-input id="name" class="block mt-1 w-full"
                                type="name"
                                name="name"
                                required autocomplete="current-password" />
    
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
            <!-- Remember Me -->
            {{-- <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div> --}}
    
            <div class="flex items-center justify-end mt-4">
                {{-- @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif --}}
    
                <x-primary-button class="ms-3">
                    {{ __('Create') }}
                </x-primary-button>
            </div>
        </form>

    </div>
</x-dashboard-layout>
