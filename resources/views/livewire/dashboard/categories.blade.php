<div class="form-group mt-2">
    <label for="prouctCateg">Category:</label>
    <select id='prouctCateg' class="form-control" wire:model='category' wire:change='categoryChanged'  name='category_id'>
        <option value="" selected>--Select-Category--</option>

        @foreach ($categories as $category)
            {
            <option value="{{ $category->category_name }}">
                {{ $category->category_name }}</option>

            }
        @endforeach

    </select>
</div>

