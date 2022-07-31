<div class="form-container">



    {{-- @if (session('status')) --}}
    {{-- <div class=" alert alert-success">{{ session('status') }}</div> --}}
    {{-- @endif --}}
    {{-- @if ($errors) --}}
    {{-- <ul> --}}
    {{-- @foreach ($errors->all() as $message) --}}
    {{-- <i style="display:block">{{ $message }}</i> --}}
    {{-- @endforeach --}}
    {{-- </ul> --}}
    {{-- @endif --}}
    <form wire:submit.prevent='submit_search'>
        <div class="row">
            <div class="col-md-6">

                @csrf
                <div class="input-group mt-4">
                    <input type="text" class="form-control" id='seach' placeholder="search products"
                        aria-label="Recipient's username" aria-describedby="button-addon2"
                        wire:model.debounce.500ms='search'>
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>

                </div>
                <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                    @error('search')
                        <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                    @enderror

                </div>


            </div>
            <div class="col-md-6">
                <div class="form-group ">
                    <label for="product_categories">Categories</label>

                    <select name="category" class="form-control" id="product_categories" wire:model='category'>

                        <option value></option>
                        @if (isset($categories))
                            {
                            @foreach ($categories as $product_category)
                                {
                                <option value="{{ $product_category->category_name }}">
                                    {{ $product_category->category_name }}</option>
                                }
                            @endforeach
                            }
                        @endif
                    </select>

                </div>
            </div>
        </div>
    </form>
    @if ($searched_products != null)

        <div class="table-container table-responsive ">
            <table  class=" table table-warning table-hover table-bordered">
                <thead>
                    <tr class=" table-danger align-middle text-center">
                        <th scope="col">Name</th>
                        <th scope="col">Product live</th>
                        <th scope="col">Product Category</th>
                        <th scope="col">Product Stock</th>
                        <th scope="col">Other Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($searched_products as $product)
                        <tr>

                            <td class=" text-center align-middle">{{ $product->product_name }}</td>
                            <td class=" text-center align-middle">{{ $product->product_live }}</td>
                            <td class=" text-center align-middle">{{ $product->category_id }}</td>
                            <td class=" text-center align-middle">{{ $product->product_stock }}</td>
                            <td class=" text-center align-middle"><a
                                    href="{{ route('product_details', ['product' => $product->id]) }}"
                                    class="btn btn-danger">Details</a></td>






                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>No products </p>


    @endif



</div>
