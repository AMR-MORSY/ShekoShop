<div class="form-group mt-2">
    <label for="prouctCateg">Devision:</label>
    <select id='prouctCateg' class="form-control" wire:model='devision' name='devision_id'>
        <option value="" selected>--Select-Devision--</option>

        @foreach ($devisions as $devision)
            {
            <option value="{{ $devision->devision_name }}">
                {{ $devision->devision_name }}</option>

            }
        @endforeach

    </select>
</div>
