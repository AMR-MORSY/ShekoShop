<div class="form-group mt-2">
    <label for="prouctCateg">Type:</label>
    <select id='prouctCateg' class="form-control" wire:model='type' name='type_id'>
        <option value="" selected>--Select-Type--</option>

        @foreach ($types as $type)
            {
            <option value="{{ $type->type_name }}">
                {{ $type->type_name }}</option>

            }
        @endforeach

    </select>
</div>
