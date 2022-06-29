

<select {{$attributes}}>

    <option value></option>
    @if (isset($categories))
        {
        @foreach ($categories as $category)
            {
            <option value="{{$category->category_name}}" {{ $isSelected($category->id)? "selected":""}}> {{ $category->category_name }}</option>

            }
        @endforeach
        }
    @endif
</select>

