<x-dashboard-layout>
    @if(Route::currentRouteName()=='product.edit')
    <h1 class="text-5xl m-3">Update Product</h1>
    @else
    <h1 class="text-5xl m-3">Create Product</h1>
    @endif

  

    <div class=" max-w-lg mx-auto bg-white m-6 p-12 rounded-lg">
        <form method="POST" action="<?php if(Route::currentRouteName()=='product.edit') echo route('product.update',["product"=>$product->id]); else echo route('product.store');?>" enctype="multipart/form-data">
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

                <!---product short desc -->

                <div class=" mt-4 col-span-2">
                    <x-input-label for="product_shortDesc" :value="__('short Description')" />
                    @if (isset($product))
                        <x-text-input id="product_shortDesc" class="block mt-1 w-full" type="text"
                            name="product_shortDesc" required autocomplete="product_shortDesc" :value="old('product_shortDesc', $product->product_shortDesc)" />
                    @else
                        <x-text-input id="product_shortDesc" class="block mt-1 w-full" type="text"
                            name="product_shortDesc" required autocomplete="product_shortDesc" :value="old('product_shortDesc')" />
                    @endif

                    <x-input-error :messages="$errors->get('product_shortDesc')" class="mt-2" />
                </div>

                <!-- product cart desc -->

                <div class=" mt-4 col-span-2">
                    <x-input-label for="product_cartDesc" :value="__('Cart Description')" />
                    @if (isset($product))
                        <x-text-input id="product_cartDesc" class="block mt-1 w-full" type="text"
                            name="product_cartDesc" required autocomplete="product_cartDesc" :value="old('product_cartDesc', $product->product_cartDesc)" />
                    @else
                        <x-text-input id="product_cartDesc" class="block mt-1 w-full" type="text"
                            name="product_cartDesc" required autocomplete="product_cartDesc" :value="old('product_cartDesc')" />
                    @endif



                    <x-input-error :messages="$errors->get('product_cartDesc')" class="mt-2" />
                </div>
                <!--- product stock--->
                <div class=" mt-4">
                    <x-input-label for="product_stock" :value="__('Stock')" />
                    @if (isset($product))
                        <x-text-input id="product_stock" class="block mt-1 w-full" type="number" name="product_stock"
                            required autocomplete="product_stock" :value="old('product_stock', $product->product_stock)" />
                    @else
                        <x-text-input id="product_stock" class="block mt-1 w-full" type="number" name="product_stock"
                            required autocomplete="product_stock" :value="old('product_stock')" />
                    @endif



                    <x-input-error :messages="$errors->get('product_stock')" class="mt-2" />
                </div>
                <!--- product live---->
                <div class=" mt-4">
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
                <!--- product category---->
                <div class=" mt-4">
                    <x-input-label for="category_id" :value="__('Category')" />

                    @if (isset($product))
                        <select name="category_id" id="category_id">
                            @foreach ($categories as $category)
                                <option :value="{{ $category->id }}" @selected($product->category_id == $category->id)>
                                    {{ $category->category_name }}</option>
                            @endforeach


                        </select>
                    @else
                        <select name="category_id" id="category_id">
                            @foreach ($categories as $category)
                                <option :value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach


                        </select>
                    @endif


                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                </div>
                <!--- product images---->
                <div class=" mt-4">

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

</x-dashboard-layout>
