<x-dashboard-layout>
    @if (Route::currentRouteName() == 'product.edit')
        <h1 class="text-5xl m-3">Update Product</h1>
    @else
        <h1 class="text-5xl m-3">Create Product</h1>
    @endif

    @php
        if (Session::has('displayAttribute')) {
            $displayAttribute = Session::get('displayAttribute');
        } else {
            $displayAttribute;
        }

    @endphp



    <div class=" max-w-lg mx-auto bg-white m-6 p-12 rounded-lg">
        <form id="getCategoryForm" method="POST" action="<?php if (Route::currentRouteName() == 'product.edit') {
            echo route('product.update', ['product' => $product->id]);
        } else {
            echo route('product.store');
        } ?>" enctype="multipart/form-data">
            @csrf

            <div class=" grid grid-cols-2 gap-4">
                <!-- product name -->
                <div class=" col-span-2 md:col-span-1">
                    <x-input-label for="product_name" :value="__('Name')" />
                    @if (isset($product))
                        <x-text-input id="product_name" class="block mt-1 w-full" type="text" name="product_name"
                            :value="old('product_name', $product->product_name)" required autofocus autocomplete="product_name" />
                    @else
                        <x-text-input id="product_name" class="block mt-1 w-full" type="text" name="product_name"
                            :value="old('product_name')" required autofocus autocomplete="product_name" />
                    @endif

                    <x-input-error :messages="$errors->get('product_name')" class="mt-2" />
                    <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                </div>

                <!-- Product price -->
                <div class=" col-span-2 md:col-span-1">
                    <x-input-label for="product_price" :value="__('Price')" />
                    @if (isset($product))
                        <x-text-input id="product_price" class="block mt-1 w-full" type="number" name="product_price"
                            required autocomplete="product_price" :value="old('product_price', $product->product_price)" />
                    @else
                        <x-text-input id="product_price" class="block mt-1 w-full" type="number" name="product_price"
                            required autocomplete="product_price" :value="old('product_price')" />
                    @endif

                    <x-input-error :messages="$errors->get('product_price')" class="mt-2" />
                </div>
                <!-- Product notes -->
                <div @class([
                    'hidden' => !$displayAttribute,
                    'col-span-2',
                    'md:col-span-1',
                ])>
                    <x-input-label for="notes" :value="__('Notes')" />
                    @if (isset($product))
                        <x-text-input id="notes" class="block mt-1 w-full" type="text" name="notes"
                            autocomplete="notes" :value="old('notes', $product->notes)" />
                    @else
                        <x-text-input id="notes" class="block mt-1 w-full" type="text" name="notes"
                            autocomplete="notes" :value="old('notes')" />
                    @endif

                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                </div>
                <!-- Product acidity -->
                <div @class([
                    'hidden' => !$displayAttribute,
                    'col-span-2',
                    'md:col-span-1',
                ])>
                    <x-input-label for="acidity" :value="__('Acidity')" />
                    @if (isset($product))
                        <x-text-input id="acidity" class="block mt-1 w-full" type="number" name="acidity"
                            autocomplete="acidity" :value="old('acidity', $product->acidity)" />
                    @else
                        <x-text-input id="acidity" class="block mt-1 w-full" type="number" name="acidity"
                            autocomplete="acidity" :value="old('acidity')" />
                    @endif

                    <x-input-error :messages="$errors->get('acidity')" class="mt-2" />
                </div>
                <!-- Product processing -->
                <div @class([
                    'hidden' => !$displayAttribute,
                    'col-span-2',
                    'md:col-span-1',
                ])>
                    <x-input-label for="processing" :value="__('Processing')" />
                    @if (isset($product))
                        <x-text-input id="processing" class="block mt-1 w-full" type="text" name="processing"
                            autocomplete="processing" :value="old('processing', $product->processing)" />
                    @else
                        <x-text-input id="processing" class="block mt-1 w-full" type="text" name="processing"
                            autocomplete="processing" :value="old('processing')" />
                    @endif

                    <x-input-error :messages="$errors->get('processing')" class="mt-2" />
                </div>
                <!-- Product body -->
                <div @class([
                    'hidden' => !$displayAttribute,
                    'col-span-2',
                    'md:col-span-1',
                ])>
                    <x-input-label for="body" :value="__('Body')" />
                    @if (isset($product))
                        <x-text-input id="body" class="block mt-1 w-full" type="text" name="body"
                            autocomplete="body" :value="old('body', $product->body)" />
                    @else
                        <x-text-input id="body" class="block mt-1 w-full" type="text" name="body"
                            autocomplete="body" :value="old('body')" />
                    @endif

                    <x-input-error :messages="$errors->get('body')" class="mt-2" />
                </div>
                <!-- Product region -->
                <div @class(['hidden' => $displayAttribute, 'col-span-2', 'md:col-span-1'])>
                    <x-input-label for="region" :value="__('Region')" />
                    @if (isset($product))
                        <x-text-input id="region" class="block mt-1 w-full" type="text" name="region"
                            autocomplete="region" :value="old('region', $product->region)" />
                    @else
                        <x-text-input id="region" class="block mt-1 w-full" type="text" name="region"
                            autocomplete="region" :value="old('region')" />
                    @endif

                    <x-input-error :messages="$errors->get('region')" class="mt-2" />
                </div>
                <!-- Product subregion -->
                <div @class([
                    'hidden' => !$displayAttribute,
                    'col-span-2',
                    'md:col-span-1',
                ])>
                    <x-input-label for="subregion" :value="__('Subregion')" />
                    @if (isset($product))
                        <x-text-input id="subregion" class="block mt-1 w-full" type="text" name="subregion"
                            autocomplete="subregion" :value="old('subregion', $product->subregion)" />
                    @else
                        <x-text-input id="subregion" class="block mt-1 w-full" type="text" name="subregion"
                            autocomplete="subregion" :value="old('subregion')" />
                    @endif

                    <x-input-error :messages="$errors->get('subregion')" class="mt-2" />
                </div>
                <!-- Product farm_owner -->
                <div @class(['hidden' => $displayAttribute, 'col-span-2', 'md:col-span-1'])>
                    <x-input-label for="farm_owner" :value="__('Farm Owner')" />
                    @if (isset($product))
                        <x-text-input id="farm_owner" class="block mt-1 w-full" type="text" name="farm_owner"
                            autocomplete="farm_owner" :value="old('farm_owner', $product->farm_owner)" />
                    @else
                        <x-text-input id="farm_owner" class="block mt-1 w-full" type="text" name="farm_owner"
                            autocomplete="farm_owner" :value="old('farm_owner')" />
                    @endif

                    <x-input-error :messages="$errors->get('farm_owner')" class="mt-2" />
                </div>
                <!-- Product Altitude -->
                <div @class([
                    'hidden' => !$displayAttribute,
                    'col-span-2',
                    'md:col-span-1',
                ])>
                    <x-input-label for="altitude" :value="__('Altitude')" />
                    @if (isset($product))
                        <x-text-input id="altitude" class="block mt-1 w-full" type="text" name="altitude"
                            autocomplete="altitude" :value="old('altitude', $product->altitude)" />
                    @else
                        <x-text-input id="altitude" class="block mt-1 w-full" type="text" name="altitude"
                            autocomplete="altitude" :value="old('altitude')" />
                    @endif

                    <x-input-error :messages="$errors->get('altitude')" class="mt-2" />
                </div>
                <!-- Product varietal -->
                <div @class([
                    'hidden' => !$displayAttribute,
                    'col-span-2',
                    'md:col-span-1',
                ])>
                    <x-input-label for="varietal" :value="__('Varietal')" />
                    @if (isset($product))
                        <x-text-input id="varietal" class="block mt-1 w-full" type="text" name="varietal"
                            autocomplete="varietal" :value="old('varietal', $product->varietal)" />
                    @else
                        <x-text-input id="varietal" class="block mt-1 w-full" type="text" name="varietal"
                            autocomplete="varietal" :value="old('varietal')" />
                    @endif

                    <x-input-error :messages="$errors->get('varietal')" class="mt-2" />
                </div>


                <!---product short desc -->

                <div class=" mt-4 col-span-2">
                    <x-input-label for="product_shortDesc" :value="__('Short Description')" />
                    @if (isset($product))
                        <x-text-input id="product_shortDesc" class="block mt-1 w-full" type="text"
                            name="product_shortDesc" required autocomplete="product_shortDesc" :value="old('product_shortDesc', $product->product_shortDesc)" />
                    @else
                        <x-text-input id="product_shortDesc" class="block mt-1 w-full" type="text"
                            name="product_shortDesc" required autocomplete="product_shortDesc" :value="old('product_shortDesc')" />
                    @endif

                    <x-input-error :messages="$errors->get('product_shortDesc')" class="mt-2" />
                </div>

                <!-- product long desc -->

                <div class=" mt-4 col-span-2">
                    <x-input-label for="product_longDesc" :value="__('Long Description')" />
                    @if (isset($product))
                        <x-text-input id="product_longDesc" class="block mt-1 w-full" type="text"
                            name="product_longDesc" required autocomplete="product_longDesc" :value="old('product_longDesc', $product->product_longDesc)" />
                    @else
                        <x-text-input id="product_longDesc" class="block mt-1 w-full" type="text"
                            name="product_longDesc" required autocomplete="product_longDesc" :value="old('product_longDesc')" />
                    @endif



                    <x-input-error :messages="$errors->get('product_longDesc')" class="mt-2" />
                </div>
                <!--- product stock--->
                <div class=" mt-4 col-span-2 md:col-span-1">
                    <x-input-label for="product_stock" :value="__('Stock')" />
                    @if (isset($product))
                        <x-text-input id="product_stock" class="block mt-1 w-full" type="number"
                            name="product_stock" required autocomplete="product_stock" :value="old('product_stock', $product->product_stock)" />
                    @else
                        <x-text-input id="product_stock" class="block mt-1 w-full" type="number"
                            name="product_stock" required autocomplete="product_stock" :value="old('product_stock')" />
                    @endif



                    <x-input-error :messages="$errors->get('product_stock')" class="mt-2" />
                </div>
                <!--- product live---->
                <div class=" mt-4 col-span-2 md:col-span-1">
                    <x-input-label for="product_live" :value="__('Live')" />

                    @if (isset($product))
                        <select name="product_live" id="product_live">
                            <option value=1 @selected($product->product_live == 1)>Yes</option>
                            <option value=0 @selected($product->product_live == 0)>No</option>
                        </select>
                    @else
                        <select name="product_live" id="product_live">
                            <option value=1>Yes</option>
                            <option value=0 selected>No</option>
                        </select>
                    @endif


                    <x-input-error :messages="$errors->get('product_live')" class="mt-2" />
                </div>
                <!--- product devisions---->
                <div class=" mt-4 col-span-2 md:col-span-1">
                    <x-input-label for="devision_id" :value="__('Devision')" />
                    @if (isset($product) && !Session::has('devision'))
                        <select name="devision_id" id="devision_id" onchange="getCategory()">
                            @foreach ($devisions as $devision)
                                <option :value="{{ $devision->id }}" @selected($product->category->devision->id == $devision->id)>
                                    {{ $devision->devision_name }}</option>
                            @endforeach


                        </select>
                    @elseif (Session::has('devision'))
                        <select name="devision_id" id="devision_id" onchange="getCategory()">
                            @foreach ($devisions as $dev)
                                <option :value="{{ $dev->id }}" @selected($dev->id == Session::get('devision')->id)>
                                    {{ $dev->devision_name }}</option>
                            @endforeach


                        </select>
                    @else
                        <select name="devision_id" id="devision_id" onchange="getCategory()">
                            @foreach ($devisions as $devision)
                                <option :value="{{ $devision->id }}">{{ $devision->devision_name }}</option>
                            @endforeach


                        </select>
                    @endif

                </div>
                <!--- product category---->
                <div class=" mt-4 col-span-2 md:col-span-1">
                    <x-input-label for="category_id" :value="__('Category')" />

                    @if (isset($product) && !Session::has('devision'))
                        <select name="category_id" id="category_id">
                            @foreach ($product->category->devision->categories as $category)
                                <option :value="{{ $category->id }}" @selected($product->category_id == $category->id)>
                                    {{ $category->category_name }}</option>
                            @endforeach


                        </select>
                    @elseif (Session::has('categories'))
                        <select name="category_id" id="category_id">
                            @foreach (Session::get('categories') as $category)
                                <option :value="{{ $category->id }}" >
                                    {{ $category->category_name }}</option>
                            @endforeach


                        </select>
                    @elseif (!Session::has('categories'))
                        <select name="category_id" id="category_id">
                            @foreach ($devisions[0]->categories as $category)
                                <option :value="{{ $category->id }}" >{{ $category->category_name }}</option>
                            @endforeach


                        </select>
                    @endif


                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                </div>
                <!--- product images---->
                <div class=" mt-4 col-span-2 md:col-span-1">

                    @if (!isset($product))
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


                    @endif


                </div>







            </div>


            <div class="flex items-center justify-end mt-4">


                <x-primary-button class="ms-3">
                    {{ __('Create') }}
                </x-primary-button>
            </div>
        </form>

    </div>

    @push('script')
        <script>
            function getCategory() {

                // document.getElementById("getCategoryForm");

                document.querySelector("#getCategoryForm").action = "/product/formManipulate";
                document.querySelector("#getCategoryForm").submit();


                // document.getElementById("getCategoryForm").submit();

            }
        </script>
    @endpush

</x-dashboard-layout>
