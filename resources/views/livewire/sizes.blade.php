<div class="row w-25 mb-2">

    <select  class="form-control size">

        @foreach ($filteredSizes as $size)
            <option value="{{ $size['id'] }}">

                {{ $size['size_name'] }}

            </option>
        @endforeach

    </select>




</div>
