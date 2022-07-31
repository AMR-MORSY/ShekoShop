<div class="form-group mt-2">
    <label for="prouctCateg">Types:</label>
    <select id='prouctCateg' class="form-control" name='type_id'>
        <option value></option>
        @if (isset($types))
            {



            @foreach ($types as $type)
                {


                <option value="{{ $type->type_name }}"
                    @if ($type->type_name == $product->type_id) {{ 'selected' }} @endif>
                    {{ $type->type_name }}</option>



                }
            @endforeach
            }
        @endif
    </select>
</div>