<div class="form-group mt-2">
    <label for="prouctCateg">Devision:</label>
    <select id='prouctCateg' class="form-control" name='devision_id'>
        <option value></option>
        @if (isset($devisions)) 
        {     
        
            @foreach ($devisions as $devision)
                {


                <option value="{{ $devision->devision_name }}"
                    @if ($devision->devision_name == $product->devision_id) {{ 'selected' }} @endif>
                    {{ $devision->devision_name }}</option>



                }
            @endforeach
        }
            
        @endif
    </select>
</div>
