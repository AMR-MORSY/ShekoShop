@extends('layouts.master')
@section('content')
    <section id="dashboard">
        <div class="container">
            <div class="d-flex justify-content-around align-items-center w-100">
                <x-gradiant-square class="gradiant-square green-gradiant">

                    <x-slot name="square">
                        hello
                    </x-slot>


                    <i class="fa-brands fa-product-hunt"></i>


                </x-gradiant-square>
                <x-gradiant-square class="gradiant-square orange-gradiant">

                    <x-slot name="square">
                        products
                    </x-slot>


                    <p>388</p>


                </x-gradiant-square>

            </div>

        </div>



        <button id="add-product-btn">add product</button>
        <x-bootstrap-modal class="add-product">

            @slot('title')
                Add Product
            @endslot
            <x-slot name="modalBody">
                @slot('errors')
                    <div class="errors">

                    </div>
                @endslot
                <div class="form-container">
                    <form id="add-product-form" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="container">
                            <div class="row">
                                @if (session('product_status'))
                                    <div class=" alert alert-success">{{ session('product_status') }}</div>
                                @endif
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="facefront_image">Facefront Image</label>
                                        <input type="file" class="form-control" id='facefront_image'
                                            name='facefront_image'>

                                    </div>
                            
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductName">Product Name</label>
                                        <input type="text" id='ProductName'
                                            class="@error('product_name') is-invalid @enderror form-control"
                                            placeholder="Product Name" value="{{ old('product_name') }}"
                                            name='product_name'>
                                    </div>
                            

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductPrice">Product Price</label>
                                        <input type="text" id='ProductPrice' class="form-control"
                                            placeholder="Product Price" value="{{ old('product_price') }}"
                                            name='product_price'>
                                    </div>
                

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group mt-2">
                                        <label for="ProductWeight">Product Weight</label>
                                        <input type="text" min="0" id='ProductWeight'
                                            value="{{ old('product_weight') }}" class="form-control"
                                            placeholder="Product Weight Kg..." name='product_weight'>
                                    </div>
                            

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductCartDesc">Prod.Cart Desc.</label>
                                        <input type="text" maxlength="250" value="{{ old('product_cartDesc') }}"
                                            id='ProductCartDesc' class="form-control" placeholder="Product Cart Desc."
                                            name='product_cartDesc'>
                                    </div>
                            

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group mt-2">
                                        <label for="ProductShortDesc">Prod.Short Desc.</label>
                                        <input type="text" maxlength="1000" id='ProductShortDesc' class="form-control"
                                            placeholder="Product Short Desc." value="{{ old('product_shortDesc') }}"
                                            name='product_shortDesc'>
                                    </div>
                              

                                </div>
                                <div class="col-12">
                                    <div class="form-group mt-2">
                                        <label for="LongDesc">Product Long Desc.</label>
                                        <textarea name="product_longDesc" class="form-control" id="LongDesc" cols="70" rows="5">{{ old('product_longDesc') }}</textarea>
                                    </div>
                            
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductThumb">Product Thumb</label>
                                        <input maxlength="100" id='ProductThumb' class="form-control"
                                            placeholder="Product Thumb" value="{{ old('product_thumb') }}"
                                            name='product_thumb'>
                                    </div>
                                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                                        @error('product_thumb')
                                            <span
                                                style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @if (isset($categories))
                                        <div class="form-group mt-2">
                                            <label for="prouctCateg">Category:</label>
                                            <select id='prouctCateg' class="form-control" wire:model='category'
                                                wire:change='changeCategory' name='category_id'>
                                                <option value="" selected>--Select-Category--</option>

                                                @foreach ($categories as $category)
                                                    {
                                                    <option value="{{ $category->category_name }}">
                                                        {{ $category->category_name }}</option>

                                                    }
                                                @endforeach

                                            </select>
                                        </div>
                                    @endIf
                              

                                </div>

                                <div class="col-md-6">
                                    @if (isset($devisions))
                                    @endIf
                                    <div class="form-group mt-2">
                                        <label for="prouctCateg">Devision:</label>
                                        <select id='prouctCateg' class="form-control" name='devision_id'>
                                            <option value="" selected>--Select-Devision--</option>

                                            @foreach ($devisions as $devision)
                                                {
                                                <option value="{{ $devision->devision_name }}">
                                                    {{ $devision->devision_name }}</option>

                                                }
                                            @endforeach

                                        </select>
                                    </div>

                               
                                </div>

                                <div class="col-md-6">
                                    @if (isset($types))
                                        <div class="form-group mt-2">
                                            <label for="prouctCateg">Type:</label>
                                            <select id='prouctCateg' class="form-control" name='type_id'>
                                                <option value="" selected>--Select-Type--</option>

                                                @foreach ($types as $type)
                                                    {
                                                    <option value="{{ $type->type_name }}">
                                                        {{ $type->type_name }}</option>

                                                    }
                                                @endforeach

                                            </select>
                                        </div>
                                    @endIf
                               

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductLocation">Prod.Location</label>
                                        <input type="text" maxlength="250" id='ProductLocation' class="form-control"
                                            placeholder="Product Location" value="{{ old('product_location') }}"
                                            name='product_location'>
                                    </div>
                                    

                                </div>

                                <div class="col-12">
                                    <x-spinner-button id='form-submit' type="submit" class="cart-delete-product mt-5">Submit
                                    </x-spinner-button>

                                </div>

                             
                                {{-- <button class="btn btn-danger "  >submit</button> --}}
                            </div>

                        </div>


                    </form>


                </div>
                @slot('footer')
                @endslot

            </x-slot>

        </x-bootstrap-modal>

        <x-bootstrap-modal class="add-color-notification">
            @slot('title')
                Add Color
            @endslot
            @slot('modalBody')
                @slot('errors')
                   
                @endslot

                <p>Product Stock is Empty:</p>
                <p>Please Add Colors and Sizes?</p>

                <input type="hidden" id='product_id'>
            @endslot
            @slot('footer')
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary" id='go-to-update'>Yes</button>
            @endslot


        </x-bootstrap-modal>
        <x-bootstrap-modal class="add-product-stock">
            @slot('title')
                Add Stock
            @endslot
            @slot('modalBody')
                @slot('errors')
                    <div class="errors">

                    </div>
                @endslot

                <form id="stock-form" method="POST">

                    <div class="container">

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="product_stock">Stock:</label>
                                    <input id="product_stock" type="text" name='product_stock'>
                                    <input type="hidden" name="product_id" id='product_id_stock'>

                                </div>

                            </div>


                        </div>

                    </div>
                @endslot
                @slot('footer')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
                    <button type="submit" class="btn btn-primary" id='submit-stock-form'>Submit</button>
                @endslot
            </form>


        </x-bootstrap-modal>


        {{-- <div class="container">
            {{-- <div class="row">
                @livewire('dashboard.addproductform', ['categories' => $categories, 'types' => $types, 'devisions' => $devisions])

                @livewire('dashboard.add-color-notification')
                @livewire('dashboard.add-stock')
                <div class="col-lg-6">
                    <div class="title">
                        <h3>Search Product</h3>
                    </div>

                    @livewire('search-product')

                <div>
                        @if (count($searched_products) > 0)
                            <div class="table-container table-responsive ">
                                <table class=" table table-warning table-hover table-bordered">
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



                    </div> --}}

        {{-- {{-- </div>
                </div>
            </div> --}}

    </section>
@endsection

@section('dashboard-scripts')
    <script>
        $(document).ready(function() {
            $('#go-to-update').on('click', function() {
                var productId = $('#product_id').val();
                var actionUrl = `product/update/${productId}`;
                window.location.href = `${actionUrl}`;
            })

            $("#add-product-btn").on('click', function() {
                $(".add-product").modal('show');

            });
           


        });

        $('#stock-form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                url: "{{ route('addStock') }}",
                type: "POST",
                data: formData, // serializes the form's elements.
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.success) {
                        var actionUrl = `details/${data.product_id}`;
                        window.location.href = `${actionUrl}`;
                    }
                },
                error: function(jqXhr, json, errorThrown) { // this are default for ajax errors 
                    var errors = jqXhr.responseJSON;
                    var errorsHtml = '';
                    $.each(errors['errors'], function(index, value) {
                        errorsHtml +=
                            '<ul ><li  style="color: red">' +
                            value[0] + '</li></ul>';
                    });
                    $('.errors').html(`${errorsHtml}`);
                },
            })
        });

        $('.add-product .btn-close').on('click',function(){
            $(".errors").html('');
            $(".form-container select").prop('selectedIndex',0);
            $(".form-container input").val('');
            $(".form-container textarea").val('');
        });

        $(".form-container input").focus(function(){
            $(".errors").html('');

        });
        $(".form-container textarea").focus(function(){
            $(".errors").html('');

        });
        $(".form-container select").change(function(){
            $(".errors").html('');
        })

        $("#add-product-form").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                url: "{{ route('addProduct') }}",
                type: "POST",
                data: formData, // serializes the form's elements.
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {

                    $(".spinner-circle").removeClass("display_none");
                    $(".spinner-circle").addClass("display_block")

                },

                complete: function() {
                    $(".spinner-circle").removeClass("display_block");
                    $(".spinner-circle").addClass("display_none")

                },
                success: function(data) {
                    console.log(data); // show response from the php script.

                    if (data.success) {
                        if (data.category_type == "Bags" || data.category_type == "Cloth" || data
                            .category_type == "Shoes") {
                            $('#product_id').val(`${data.product_id}`);
                            $(".add-product").modal('hide');
                            $(".add-color-notification").modal('show');

                        } else {
                            $('#product_id_stock').val(`${data.product_id}`);
                            $(".add-product").modal('hide');
                            $(".add-product-stock").modal('show');


                        }

                    }
                },
                error: function(jqXhr, json, errorThrown) { // this are default for ajax errors 
                    var errors = jqXhr.responseJSON;
                    var errorsHtml = '';
                    $.each(errors['errors'], function(index, value) {
                        errorsHtml +=
                            '<ul ><li  style="color: red">' +
                            value[0] + '</li></ul>';
                    });
                    $('.errors').html(`${errorsHtml}`);
                    console.log(errors);
                    //I use SweetAlert2 for this
                    // swal({
                    //     title: "Error " + jqXhr.status + ': ' +
                    //         errorThrown, // this will output "Error 422: Unprocessable Entity"
                    //     html: errorsHtml,
                    //     width: 'auto',
                    //     confirmButtonText: 'Try again',
                    //     cancelButtonText: 'Cancel',
                    //     confirmButtonClass: 'btn',
                    //     cancelButtonClass: 'cancel-class',
                    //     showCancelButton: true,
                    //     closeOnConfirm: true,
                    //     closeOnCancel: true,
                    //     type: 'error'
                    // }, function(isConfirm) {
                    //     if (isConfirm) {
                    //         $('#openModal').click(); //this is when the form is in a modal
                    //     }
                    // });

                }
            });


        });
    </script>
@endsection
