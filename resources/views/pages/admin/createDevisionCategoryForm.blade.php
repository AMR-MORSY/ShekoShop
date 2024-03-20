<x-dashboard-layout>
    @if (Route::currentRouteName() == 'devision.edit')
        <h1 class="text-5xl m-3">Update Devision</h1>
    @endif
    @if (Route::currentRouteName() == 'devision.create')
        <h1 class="text-5xl m-3">Create Devision</h1>
    @endif
    @if (Route::currentRouteName() == 'category.edit')
        <h1 class="text-5xl m-3">Update Category</h1>
    @endif
    @if (Route::currentRouteName() == 'category.create')
        <h1 class="text-5xl m-3">Create Category</h1>
    @endif



    <div class=" max-w-lg mx-auto bg-white m-6 p-12 rounded-lg">
        <form method="POST" action="<?php if (Route::currentRouteName() == 'devision.edit') {
            echo route('devision.update', ['devision' => $devision->id]);
        } elseif (Route::currentRouteName() == 'category.edit') {
            echo route('category.update', ['category' => $category->id]);
        } elseif (Route::currentRouteName() == 'devision.create') {
            echo route('devision.store');
        } elseif (Route::currentRouteName() == 'category.create') {
            echo route('category.store');
        }
        
        ?>" enctype="multipart/form-data">
            @csrf

            <div class=" grid grid-cols-2 gap-4">

                <div class=" col-span-2 md:col-span-1">
                    <x-input-label for="devision_name" :value="__('Name')" />
                    <!-- devision name -->
                    @if ((Route::currentRouteName() == 'devision.create') | (Route::currentRouteName() == 'devision.edit'))


                        @if (Route::currentRouteName() == 'devision.create')
                            <x-text-input id="devision_name" class="block mt-1 w-full" type="text"
                                name="devision_name" :value="old('devision_name')" required autofocus
                                autocomplete="devision_name" />
                        @endif
                        @if (Route::currentRouteName() == 'devision.edit')
                            <x-text-input id="devision_name" class="block mt-1 w-full" type="text"
                                name="devision_name" :value="old('devision_name', $devision->devision_name)" required autofocus
                                autocomplete="devision_name" />
                        @endif

                        <x-input-error :messages="$errors->get('devision_name')" class="mt-2" />



                    @endif
                    <!-- category name -->
                    @if ((Route::currentRouteName() == 'category.create') | (Route::currentRouteName() == 'category.edit'))

                        @if (Route::currentRouteName() == 'category.create')
                            <x-text-input id="category_name" class="block mt-1 w-full" type="text"
                                name="category_name" :value="old('category_name')" required autofocus
                                autocomplete="category_name" />
                        @endif
                        @if (Route::currentRouteName() == 'category.edit')
                            <x-text-input id="category_name" class="block mt-1 w-full" type="text"
                                name="category_name" :value="old('category_name', $category->category_name)" required autofocus
                                autocomplete="category_name" />
                        @endif

                        <x-input-error :messages="$errors->get('category_name')" class="mt-2" />



                    @endif



                    <x-input-error :messages="$errors->get('slug')" class="mt-2" />


                </div>




                <!---devision desc -->

                <div class=" mt-4 col-span-2">
                    <x-input-label for="description" :value="__('Description')" />
                    @if ((Route::currentRouteName() == 'devision.create') | (Route::currentRouteName() == 'devision.edit'))
                        @if (Route::currentRouteName() == 'devision.create')
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                                required autocomplete="description" :value="old('description')" />
                        @else
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                                required autocomplete="description" :value="old('description', $devision->description)" />
                        @endif
                    @endif
                    @if ((Route::currentRouteName() == 'category.create') | (Route::currentRouteName() == 'category.edit'))
                        @if (Route::currentRouteName() == 'category.create')
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                                required autocomplete="description" :value="old('description')" />
                        @else
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                                required autocomplete="description" :value="old('description', $category->description)" />
                        @endif
                    @endif

                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!------Category devisoin Id------->

                @if ( (Route::currentRouteName() == 'category.create'))

                    <select name="devision_id" id="devision_id">
                        @foreach ($devisions as $devision)
                            <option value="{{ $devision->id }}">{{ $devision->devision_name }}</option>
                        @endforeach


                    </select>

                @endif
                @if ((Route::currentRouteName() == 'category.edit') )
                <select name="devision_id" id="devision_id">
                    @foreach ($devisions as $devision)
                        <option value="{{ $devision->id }}" @selected($category->devision->id==$devision->id)>{{ $devision->devision_name }}</option>
                    @endforeach


                </select>

                    
                @endif


                <!--- devision images---->
                @if ((Route::currentRouteName() == 'devision.create') | (Route::currentRouteName() == 'category.create'))
                    <div class=" mt-4">


                        <x-input-label for="images" :value="__('images')" />
                        <input id="images" class="block mt-1 w-full" type='file' multiple name="images[]"
                            autocomplete="images" />

                        <x-input-error :messages="$errors->get('images')" class="mt-2" />
                        @if ($errors)
                            @foreach ($errors->get('images.*') as $items)
                                @foreach ($items as $item)
                                    <p class=" text-red-400">{{ $item }}</p>
                                @endforeach
                            @endforeach


                        @endif





                    </div>
                @endif








            </div>


            <div class="flex items-center justify-end mt-4">


                <x-primary-button class="ms-3">
                    {{ __('Create') }}
                </x-primary-button>
            </div>
        </form>

    </div>
</x-dashboard-layout>
