
<x-dashboard-layout>

    @if (Route::currentRouteName()=='role.create')
    <h1 class=" text-start text-5xl m-3">Create Role</h1>
    @else
    <h1 class=" text-start text-5xl m-3">Create Permission</h1>  
    @endif

    <div class=" max-w-lg mx-auto bg-white m-6 p-12 rounded-lg">
        <form method="POST" action="<?php if(Route::currentRouteName()=='role.create') echo route('role.store'); else echo route('Permission.store');?>">
            @csrf
    
            <div class="mt-4">
                <x-input-label for="name" :value="__('name')" />
    
                <x-text-input id="name" class="block mt-1 w-full"
                                type="name"
                                name="name"
                                required autocomplete="current-password" />
    
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
    
           
            <div class="flex items-center justify-end mt-4">
              
    
                <x-primary-button class="ms-3">
                    {{ __('Create') }}
                </x-primary-button>
            </div>
        </form>

    </div>
</x-dashboard-layout>
