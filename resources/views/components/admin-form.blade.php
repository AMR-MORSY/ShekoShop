@props(['title', 'route', 'target'])


<h1 class="text-5xl m-3">{{ $title }}</h1>

<div class=" max-w-4xl mx-auto bg-white m-6 p-12 rounded-lg">
    <form id="getCategoryForm" method="POST" action='{{$route}}' enctype="multipart/form-data">
        @csrf
        <div class=" grid grid-cols-4 gap-4">
            {{ $slot }}
            <x-input-error :messages="$errors->get('slug')" class="mt-2" />

            <div class="col-span-4 md:col-span-2">


                <x-input-label for="images" :value="__('images')" />
                <input id="images" class="product-text-input" type='file' multiple name="images[]"
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


        </div>
        <!--- devision images---->






        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ms-3">
                {{ __($target) }}
            </x-primary-button>
        </div>


    </form>
</div>
