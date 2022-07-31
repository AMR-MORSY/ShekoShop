<div class="form-group mt-2">
    <label for="prouctCateg">Category:</label>


    <select id='prouctCateg' class="form-control" wire:model='product_category' wire:change='categoryChanged'
        name='category_id'>
        <option value></option>
        @if (isset($categories))
            {

            @foreach ($categories as $category)
                {


                <option value="{{ $category->category_name }}"
                    {{-- @if ($category->category_name == $product->category_id) {{ 'selected' }} @endif> --}}>
                    {{ $category->category_name }}</option>



                }
            @endforeach
            }
        @endif
    </select>
</div>
