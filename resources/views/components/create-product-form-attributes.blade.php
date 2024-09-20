@props(['displayAttribute', 'product', 'target'])


<!-- product name -->
<div class=" col-span-2 md:col-span-1">
    <x-input-label for="product_name" :value="__('Name')" />

    <input id="product_name" class="product-text-input" type="text" name="product_name" value="<?php if (isset($product)) {
        echo old('product_name', $product->product_name);
    } else {
        echo old('product_name');
    } ?>"
        required autocomplete="product_name" />

    <x-input-error :messages="$errors->get('product_name')" class="mt-2" />

</div>

<!-- Product price -->
<div class=" col-span-2 md:col-span-1">
    <x-input-label for="product_price" :value="__('Price')" />

    <input id="product_price" class="product-text-input" type="number" name="product_price" required
        autocomplete="product_price" value="<?php if (isset($product)) {
            echo old('product_price', $product->product_price);
        } else {
            echo old('product_price');
        } ?>" />

    <x-input-error :messages="$errors->get('product_price')" class="mt-2" />
</div>
<!-- Product notes -->
<div @class([
    'hidden' => !$displayAttribute,
    'col-span-2',
    'md:col-span-1',
])>
    <x-input-label for="notes" :value="__('Notes')" />

    <input id="notes" class="product-text-input" type="text" name="notes" autocomplete="notes"
        value="<?php if (isset($product)) {
            echo old('notes', $product->notes);
        } else {
            echo old('notes');
        } ?>" />


    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
</div>
<!-- Product acidity -->
<div @class([
    'hidden' => !$displayAttribute,
    'col-span-2',
    'md:col-span-1',
])>
    <x-input-label for="acidity" :value="__('Acidity')" />
    <input id="acidity" class="product-text-input" type="text" name="acidity" autocomplete="acidity"
        value="<?php if (isset($product)) {
            echo old('acidity', $product->acidity);
        } else {
            echo old('acidity');
        } ?>" />
 

    <x-input-error :messages="$errors->get('acidity')" class="mt-2" />
</div>
<!-- Product processing -->
<div @class([
    'hidden' => !$displayAttribute,
    'col-span-2',
    'md:col-span-1',
])>
    <x-input-label for="processing" :value="__('Processing')" />
    <input id="processing" class="product-text-input" type="text" name="processing" autocomplete="processing"
        value="<?php if (isset($product)) {
            echo old('processing', $product->processing);
        } else {
            echo old('processing');
        } ?>" />
  

    <x-input-error :messages="$errors->get('processing')" class="mt-2" />
</div>
<!-- Product body -->
<div @class([
    'hidden' => !$displayAttribute,
    'col-span-2',
    'md:col-span-1',
])>
    <x-input-label for="body" :value="__('Body')" />
    <input id="body" class="product-text-input" type="text" name="body" autocomplete="body"
        value="<?php if (isset($product)) {
            echo old('body', $product->body);
        } else {
            echo old('body');
        } ?>" />
   

    <x-input-error :messages="$errors->get('body')" class="mt-2" />
</div>
<!-- Product region -->
<div @class(['hidden' => $displayAttribute, 'col-span-2', 'md:col-span-1'])>
    <x-input-label for="region" :value="__('Region')" />
    <input id="region" class="product-text-input" type="text" name="region" autocomplete="region"
        value="<?php if (isset($product)) {
            echo old('region', $product->region);
        } else {
            echo old('region');
        } ?>" />
  

    <x-input-error :messages="$errors->get('region')" class="mt-2" />
</div>
<!-- Product subregion -->
<div @class([
    'hidden' => !$displayAttribute,
    'col-span-2',
    'md:col-span-1',
])>
    <x-input-label for="subregion" :value="__('Subregion')" />
    <input id="subregion" class="product-text-input" type="text" name="subregion" autocomplete="subregion"
        value="<?php if (isset($product)) {
            echo old('subsubregion', $product->subregion);
        } else {
            echo old('subregion');
        } ?>" />
  

    <x-input-error :messages="$errors->get('subregion')" class="mt-2" />
</div>
<!-- Product farm_owner -->
<div @class(['hidden' => $displayAttribute, 'col-span-2', 'md:col-span-1'])>
    <x-input-label for="farm_owner" :value="__('Farm Owner')" />
    <input id="farm_owner" class="product-text-input" type="text" name="farm_owner" autocomplete="farm_owner"
        value="<?php if (isset($product)) {
            echo old('farm_owner', $product->farm_owner);
        } else {
            echo old('farm_owner');
        } ?>" />
   

    <x-input-error :messages="$errors->get('farm_owner')" class="mt-2" />
</div>
<!-- Product Altitude -->
<div @class([
    'hidden' => !$displayAttribute,
    'col-span-2',
    'md:col-span-1',
])>
    <x-input-label for="altitude" :value="__('Altitude')" />
    <input id="altitude" class="product-text-input" type="text" name="altitude" autocomplete="altitude"
        value="<?php if (isset($product)) {
            echo old('altitude', $product->altitude);
        } else {
            echo old('altitude');
        } ?>" />
   
    <x-input-error :messages="$errors->get('altitude')" class="mt-2" />
</div>
<!-- Product varietal -->
<div @class([
    'hidden' => !$displayAttribute,
    'col-span-2',
    'md:col-span-1',
])>
    <x-input-label for="varietal" :value="__('Varietal')" />
    <input id="varietal" class="product-text-input" type="text" name="varietal" autocomplete="varietal"
        value="<?php if (isset($product)) {
            echo old('varietal', $product->varietal);
        } else {
            echo old('varietal');
        } ?>" />
   

    <x-input-error :messages="$errors->get('varietal')" class="mt-2" />
</div>
<!--- product stock--->
<div class="  col-span-2 md:col-span-1">
    <x-input-label for="product_stock" :value="__('Stock')" />
    <input id="product_stock" class="product-text-input" type="text" name="product_stock"
        autocomplete="product_stock" value="<?php if (isset($product)) {
            echo old('product_stock', $product->product_stock);
        } else {
            echo old('product_stock');
        } ?>" />
   



    <x-input-error :messages="$errors->get('product_stock')" class="mt-2" />
</div>
<!--- product live---->
<div class="  col-span-2 md:col-span-1">
    <x-input-label for="product_live" :value="__('Live')" />

    @if (isset($product))
        <select name="product_live" class="product-text-input" id="product_live">
            <option value=1 @selected($product->product_live == 1)>Yes</option>
            <option value=0 @selected($product->product_live == 0)>No</option>
        </select>
    @else
        <select name="product_live" class="product-text-input" id="product_live">
            <option value=1>Yes</option>
            <option value=0 selected>No</option>
        </select>
    @endif


    <x-input-error :messages="$errors->get('product_live')" class="mt-2" />
</div>
<!---product short desc -->

<div class="  col-span-2">
    <x-input-label for="product_shortDesc" :value="__('Short Description')" />
    <input id="product_shortDesc" class="product-text-input" type="text" name="product_shortDesc"
        autocomplete="product_shortDesc" value="<?php if (isset($product)) {
            echo old('product_shortDesc', $product->product_shortDesc);
        } else {
            echo old('product_shortDesc');
        } ?>" />
  

    <x-input-error :messages="$errors->get('product_shortDesc')" class="mt-2" />
</div>

<!-- product long desc -->

<div class=" col-span-2">
    <x-input-label for="product_longDesc" :value="__('Long Description')" />
    <input id="product_longDesc" class="product-text-input" type="text" name="product_longDesc"
        autocomplete="product_longDesc" value="<?php if (isset($product)) {
            echo old('product_longDesc', $product->product_longDesc);
        } else {
            echo old('product_longDesc');
        } ?>" />
   


    <x-input-error :messages="$errors->get('product_longDesc')" class="mt-2" />
</div>

<!--- product devisions---->
<div class="  col-span-2 md:col-span-1">
    <x-input-label for="devision_id" :value="__('Devision')" />
   
        <select name="devision_id" id="devision_id" class="product-text-input" onchange="getCategory()">
            @if (isset($product) && !Session::has('devision'))
                @foreach ($devisions as $devision)
                    <option :value="{{ $devision->id }}" @selected($product->category->devision->id == $devision->id)>
                        {{ $devision->devision_name }}</option>
                @endforeach
            @elseif (Session::has('devision'))
                @foreach ($devisions as $dev)
                    <option :value="{{ $dev->id }}" @selected($dev->id == Session::get('devision')->id)>
                        {{ $dev->devision_name }}</option>
                @endforeach
            @else
                @foreach ($devisions as $devision)
                    <option :value="{{ $devision->id }}">{{ $devision->devision_name }}</option>
                @endforeach
            @endif






        </select>
</div>
<!--- product category---->
<div class="  col-span-2 md:col-span-1">
    <x-input-label for="category_id" :value="__('Category')" />


    <select name="category_id" class="product-text-input" id="category_id">
        @if (isset($product) && !Session::has('devision'))
            @foreach ($product->category->devision->categories as $category)
                <option :value="{{ $category->id }}" @selected($product->category_id == $category->id)>
                    {{ $category->category_name }}</option>
            @endforeach
        @elseif (Session::has('categories'))
            @foreach (Session::get('categories') as $category)
                <option :value="{{ $category->id }}">
                    {{ $category->category_name }}</option>
            @endforeach
        @elseif (!Session::has('categories'))
            @foreach ($devisions[0]->categories as $category)
                <option :value="{{ $category->id }}">{{ $category->category_name }}</option>
            @endforeach
        @endif


    </select>

    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
</div>

@push('script')
    <script>
        function getCategory() {

          

            document.querySelector("#getCategoryForm").action = "/admin/product/formManipulate";
            document.querySelector("#getCategoryForm").submit();


           

        }
    </script>
@endpush
