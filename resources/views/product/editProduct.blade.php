@extends('layouts.master')
@section('content')
    {{-- @php
       dd($product->id);
   @endphp --}}
    <section id="add-products">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="title">
                        <h3>Add Product</h3>

                    </div>
                    <div class="form-container">
                        <form method="POST" action="{{ route('addProduct') }}" enctype="multipart/form-data">
                            @csrf

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
                                            placeholder="Product Name" value="{{ $product->product_name }}"
                                            name='product_name'>
                                    </div>
                                    <div class="w-100 d-flex justify-content-start align-items-center mt-3">
                                        @error('product_name', 'store_product')
                                            <span
                                                style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductPrice">Product Price</label>
                                        <input type="number" min="1" id='ProductPrice' class="form-control"
                                            placeholder="Product Price" value="{{ $product->product_price }}"
                                            name='product_price'>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group mt-2">
                                        <label for="ProductWeight">Product Weight</label>
                                        <input type="number" min="0" id='ProductWeight'
                                            value="{{ $product->product_weight }}" class="form-control"
                                            placeholder="Product Weight Kg..." name='product_weight'>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductCartDesc">Prod.Cart Desc.</label>
                                        <input type="text" maxlength="250" value="{{ $product->product_cartDesc }}"
                                            id='ProductCartDesc' class="form-control" placeholder="Product Cart Desc."
                                            name='product_cartDesc'>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="form-group mt-2">
                                        <label for="ProductShortDesc">Prod.Short Desc.</label>
                                        <input type="text" maxlength="1000" id='ProductShortDesc' class="form-control"
                                            placeholder="Product Short Desc." value="{{ $product->product_shortDesc }}"
                                            name='product_shortDesc'>
                                    </div>

                                </div>
                                <div class="col-12">
                                    <div class="form-group mt-2">
                                        <label for="LongDesc">Product Long Desc.</label>
                                        <textarea name="product_longDesc" id="LongDesc" cols="70" rows="5">{{ $product->product_longDesc }}</textarea>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductThumb">Product Thumb</label>
                                        <input maxlength="100" id='ProductThumb' class="form-control"
                                            placeholder="Product Thumb" value="{{ $product->product_thumb }}"
                                            name='product_thumb'>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    @livewire('editproduct.categories', ['product' => $product, 'categories' => $categories])

                                </div>
                                <div class="col-md-6">
                                    @livewire('editproduct.devisions', ['product' => $product])


                                </div>
                                <div class="col-md-6">
                                    @livewire('editproduct.types', ['product' => $product, 'types' => $types])


                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for='ProductLive'>Availability:</label>
                                        <select name='product_live' class="form-control" id='ProductLive'>
                                            <option value="1"
                                                @if ($product->product_live == '1') {{ 'selected' }} @endif>Available
                                            </option>
                                            <option value="0"
                                                @if ($product->product_live == '0') {{ 'selected' }} @endif>Unavailable
                                            </option>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mt-2">
                                        <label for="ProductLocation">Prod.Location</label>
                                        <input type="text" maxlength="250" id='ProductLocation' class="form-control"
                                            placeholder="Product Location" value="{{ $product->product_location }}"
                                            name='product_location'>
                                    </div>

                                </div>



                                <button class="btn btn-danger mt-5" type="submit">submit</button>

                            </div>

                        </form>


                    </div>
                </div>
                <div class="col-lg-6 mt-5">
                    <div class="row">
                        @error('facefront_image', 'update_facefront')
                            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                        @enderror
                        @if (session('image_delete_success'))
                            <div class=" alert alert-success">{{ session('image_delete_success') }}</div>
                        @endif
                        @if (session('delete_product_color'))
                            <div class=" alert alert-success">{{ session('delete_product_color') }}</div>
                        @endif
                        @if (session('sizes_updated'))
                            <div class=" alert alert-success">{{ session('sizes_updated') }}</div>
                        @endif

                        @if ($errors->any())
                            <span
                                style="color: red; font-size:0.75rem; text-align:left;">{{ $errors->first('last_image') }}</span>
                            <span
                                style="color: red; font-size:0.75rem; text-align:left;">{{ $errors->first('images') }}</span>
                        @endif
                        @error('color', 'update_color_size')
                            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                        @enderror
                        @error('product', 'update_color_size')
                            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                        @enderror
                        @error('size', 'update_color_size')
                            <span style="color: red; font-size:0.75rem; text-align:left;">{{ $message }}</span>
                        @enderror
                        <div class="col-md-6">
                            <form action="{{ route('update_facefront_image') }}" enctype="multipart/form-data"
                                method="Post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Add Facefront Image:</label>
                                    <input type="file" name="facefront_image">
                                </div>
                                <input type="hidden" name="product" value="{{ $product->id }}">
                                <div class="form-group mt-3">
                                    <button class="btn btn-info" type="submit">Update</button>
                                </div>
                            </form>
                        </div>

                        <div class="col-md-4">

                            <div class="image-container">
                                <img class="w-100" src={{ $facefront_image }} alt="">
                            </div>
                            <div class="face-front-caption">
                                <p style="color: red">Facefront Image</p>
                            </div>



                        </div>
                        <div class="col-12">

                            {{-- @php
                                function filter_array($unfiltered_array, $color_name)
                                {
                                    $filtered = array_filter(
                                        $unfiltered_array,
                                        function ($key) use ($color_name) {
                                            return $key == $color_name;
                                        },
                                        ARRAY_FILTER_USE_KEY,
                                    );
                                    return $filtered;
                                }
                            @endphp --}}
                            <div class="row">
                                {{-- @if (isset($product_colors))
                                    @for ($v = 0; $v < count($product_colors); $v++)
                                        {{ $product_colors[$v]->color_name }}

                                        <div class="col-12 ">

                                            @php
                                                $color = $product_colors[$v]->id;
                                                $filtered = filter_array($product_sizes, $color);
                                                $filtered_quantities = filter_array($quantities, $color);
                                                $filtered_images_urls = filter_array($product_images_urls, $color);
                                                $filtered_images_ids = filter_array($product_images_ids, $color);
                                                $color_images_ids = null;
                                                foreach ($filtered_images_ids as $key => $value) {
                                                    $color_images_ids = $value;
                                                }
                                                $images_ids = $color_images_ids;
                                                
                                                $color_images_urls = null;
                                                
                                                foreach ($filtered_images_urls as $key => $value) {
                                                    $color_images_urls = $value;
                                                }
                                                $images_urls = $color_images_urls;
                                                $color_sizes = null;
                                                foreach ($filtered as $key => $value) {
                                                    $color_sizes = $value;
                                                }
                                                $filtered_sizes = $color_sizes;
                                                $color_quantities = null;
                                                foreach ($filtered_quantities as $key => $value) {
                                                    $color_quantities = $value;
                                                }
                                                
                                            @endphp
                                            <div class="row">
                                                <div class="col-4">
                                                    <p>Available Sizes:</p>
                                                    @foreach ($filtered_sizes as $size)
                                                        <p>{{ $size->size_name }}</p>
                                                    @endforeach

                                                </div>
                                                <div class="col-4">
                                                    <p>Quantities:</p>
                                                    @foreach ($color_quantities as $quantity)
                                                        <p>{{ $quantity }}</p>
                                                    @endforeach
                                                </div>
                                                <div class="col-4">
                                                    @livewire('editproduct.updatesize-btn', ['color_id' => $color, 'color_quantities' => $color_quantities, 'filtered_sizes' => $filtered_sizes], key($v))
                                                </div>
                                            </div>



                                        </div>



                                        <div class="col-12">



                                            @livewire('editproduct.carousel', ['product_id' => $product->id, 'color_id' => $product_colors[$v]->id, 'images_ids' => $images_ids, 'images_urls' => $images_urls], key($v))



                                        </div>
                                        <div class="col-12">
                                            <div class="delete-button-container">
                                                <a href="{{ route('delete-product-color', ['product' => $product->id, 'color' => $product_colors[$v]->id]) }}"
                                                    class="btn btn-danger">Delete Color</a>
                                            </div>
                                        </div>
                                    @endfor
                                @endif --}}

                                @if ($product->category_id == 'Bags' or $product->category_id == 'Cloth' or $product->category_id == 'Shoes')
                                    <div class="col-12">
                                        {{-- @livewire('editproduct.addcolorbtn') --}}
                                        <div class="input-group mt-2">
                                            <button type="button" class="btn btn-danger" id='add-color-Btn'>Add
                                                Color</button>
                                        </div>


                                    </div>
                                    {{-- @php
                                        $product_color_size = $product_color_size->groupBy('color_id');
                                        
                                    @endphp --}}

                                    @if (isset($product_color_size))
                                        <div class="table-container table-responsive ">
                                            <table class=" table table-warning table-hover table-bordered">
                                                <thead>
                                                    <tr class=" table-danger align-middle text-center">
                                                        <th scope="col">Color</th>
                                                        <th scope="col">Available Sizes</th>
                                                        <th scope="col">Sizes Quantities</th>
                                                        <th scope="col"></th>
                                                        <th scope="col"></th>
                                                        <th scope="col"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($product_color_size as $key => $prod)
                                                        <tr>
                                                            @foreach ($colors as $color)
                                                                @if ($color->id == $key)
                                                                    <td class=" text-center align-middle">


                                                                        <p>{{ $color->color_name }}</p>
                                                                        <input type="hidden"
                                                                            value="{{ $color->id }}">

                                                                    </td>
                                                                @endif
                                                            @endforeach

                                                            <td class=" text-center align-middle">
                                                                @foreach ($prod as $item)
                                                                    @foreach ($sizes as $size)
                                                                        @if ($size->id == $item->size_id)
                                                                            <p>{{ $size->size_name }}</p>
                                                                            <input type="hidden"
                                                                                value="{{ $size->id }}">
                                                                        @endif
                                                                    @endforeach
                                                                @endforeach
                                                            </td>
                                                            <td class=" text-center align-middle">
                                                                @foreach ($prod as $item)
                                                                    <p>{{ $item->quantity }}</p>
                                                                @endforeach
                                                            </td>
                                                            <td class=" text-center align-middle">
                                                                <button class="btn btn-danger"
                                                                    onclick="deleteColor({{ $key }},{{ $product->id }})">Delete
                                                                    Color</button>
                                                            </td>
                                                            <td class=" text-center align-middle">
                                                                <button class="btn btn-danger"
                                                                    onclick="viewImages('{{ $key }},{{ $product->id }}')">View
                                                                    Images</button>
                                                            </td>

                                                            <td class=" text-center align-middle">

                                                                <button class="btn btn-danger"
                                                                    onclick="updatesizes({{ $key }},{{ $product->id }})">Update
                                                                    Size </button>


                                                            </td>



                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                @endif





                            </div>

                        </div>



                        {{-- @livewire('editproduct.add-product-color', ['colors' => $colors, 'sizes' => $sizes, 'product_id' => $product->id]) --}}
                        {{-- @livewire('editproduct.updatesize', ['sizes' => $sizes, 'product_id' => $product->id])
                        @livewire('editproduct.color-delete-confirmation') --}}



                    </div>
                </div>

            </div>

        </div>

    </section>

    <x-bootstrap-modal class="success-notification">
        @slot('title')
            <div>
                <p>Success<span><i class="fa-solid fa-check-double"></i></span></p>
            </div>
        @endslot
        @slot('modalBody')
            @slot('errors')
                <div class="errors">

                </div>
            @endslot
            <div>
                <p class="success-message"></p>
            </div>
        @endslot

        @slot('footer')
            <button type="button" class="btn btn-secondary dismissModal" data-bs-dismiss="modal">close</button>
        @endslot


    </x-bootstrap-modal>

    <x-bootstrap-modal class="update-size">
        @slot('title')
            Update Size
        @endslot
        <x-slot name="modalBody">
            @slot('errors')
                <div class="errors">

                </div>
            @endslot

            <div class="container">
                <div class="size-collection">

                </div>

                <div class="new-size mt-3">
                    <form method="POST" id="submit_new_size">
                        <input type="hidden" name="product_id" id="product_id">
                        <input type="hidden" name="color_id" id="color_id">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="new-sizes">Size:</label>
                                    <select id='new-sizes' name="size_id" class="form-control">
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="new-quantity">quantity</label>
                                    <input type="number" name="quantity" class="form-control" id='new-quantity' min=1>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <x-spinner-button type="submit" class="add-new-size">Submit
                                </x-spinner-button>

                            </div>
                        </div>

                    </form>

                </div>
            </div>



        </x-slot>
        @slot('footer')
            <button type="button" class="btn btn-secondary dismissModal" data-bs-dismiss="modal">close</button>
        @endslot

    </x-bootstrap-modal>

    <x-bootstrap-modal class="add-color-form">

        @slot('title')
            Add Color
        @endslot
        <x-slot name="modalBody">
            @slot('errors')
                <div class="errors">

                </div>
            @endslot

            <form id="add_prod_color_form" method="POST" enctype="multipart/form-data">

                <div class="container">
                    <input type="hidden" id="prod_id" value="{{ $product->id }}" name="product_id">
                    <div class="row collection mt-3">

                        <div class="col-12 col-md-2">
                            <div class="form-group">
                                <label for="color">Color:</label>
                                <select class="form-control" name=color>

                                    <option value=""></option>
                                    @foreach ($colors as $color)
                                        <option value={{ $color->id }}>{{ $color->color_name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-3 ">
                            <div class="form-group ">
                                <label for="sizes">Sizes</label>
                                <select name="size" class="form-control" id="sizes">
                                    <option value=""></option>
                                    @foreach ($sizes as $size)
                                        <option value="{{ $size->id }}">
                                            {{ $size->size_name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                        <div class="col-12 col-md-2 ">
                            <div class="form-group">
                                <label for="quantites">Quantites</label>
                                <input type="number" class="form-control" min="1" name="quantity">

                            </div>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="form-group ">
                                <label for="images">images:</label>
                                <input type="file" id="images" class="form-control" name="images[]" multiple>
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="form-group mt-2">

                            </div>
                        </div>


                    </div>


                </div>

                <x-spinner-button class="add-color">Add Color</x-spinner-button>
            </form>

            @slot('footer')
                <button type="button" class="btn btn-secondary dismissModal" data-bs-dismiss="modal">close</button>
            @endslot



        </x-slot>

    </x-bootstrap-modal>

    <x-bootstrap-modal class="delete-color-confirmation">
        @slot('title')
            Delete Color
        @endslot

        <x-slot name="modalBody">
            @slot('errors')
                {{-- <div class="errors">

                </div> --}}
            @endslot

            <p>Are You Shure? This will delete the color and its photos and sizes</p>

            <input type="hidden" id="color_id">
            <input type="hidden" id=product_id>


        </x-slot>




        @slot('footer')
            <x-spinner-button class="delete_color_btn">Yes</x-spinner-button>
            <button type="button" class="btn btn-secondary dismissModal" data-bs-dismiss="modal">No</button>
        @endslot


    </x-bootstrap-modal>
    <x-bootstrap-modal class="delete-size-confirmation">
        @slot('title')
            Delete Size
        @endslot

        <x-slot name="modalBody">
            @slot('errors')
                {{-- <div class="errors">

                </div> --}}
            @endslot

            <p>Are You Shure? This will delete the Size</p>

            {{-- <input type="hidden" id="color_id">
            <input type="hidden" id=product_id> --}}


        </x-slot>




        @slot('footer')
            <x-spinner-button class="delete-size">Yes</x-spinner-button>
            <button type="button" class="btn btn-secondary dismissModal" data-bs-dismiss="modal">No</button>
        @endslot


    </x-bootstrap-modal>
@endsection

@section('edit-product-scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {


            const swiper = new Swiper(".swiper", {
                speed: 400,
                breakpointsBase: "container",
                navigation: {
                    nextEl: ".swiper-next",
                    prevEl: ".swiper-prev",
                    hiddenClass: "swiper-button-hidden",
                    hideOnClick: true,
                },
                observer: true,
                observeParents: true,
                parallax: true,

                autoHeight: true,
                loop: false,
                // allowSlideNext:true,

                breakpoints: {
                    // when window width is >= 320px
                    320: {
                        slidesPerView: 2,
                        spaceBetween: 3,
                    },

                    // when window width is >= 640px
                    767: {
                        slidesPerView: 4,
                        spaceBetween: 3,
                    },
                },
            });




        });



        $('#add-color-Btn').on('click', function() {
            $('.add-color-form').modal('show');

        })

        $(".collection input").focus(function() {
            $('.errors').html("");

        })
        $(".collection select").change(function() {
            $('.errors').html("");

        })
        $('.add-color-form .dismissModal').on('click', function() {
            $('.errors').html("");
            $(".collection select").prop("selectedIndex", 0);
            $(".collection input").val("");

        });
        $('.add-color-form .btn-close').on('click', function() {
            $('.errors').html("");
            $(".collection select").prop("selectedIndex", 0);
            $(".collection input").val("");

        });

        $(".success-notification .dismissModal").on("click", function() {
            location.reload();

        });
        $('.success-notification .btn-close').on('click', function() {
            location.reload();


        });

        $("#submit_new_size").submit(function(e) {
            e.preventDefault();
            $('.update-size .errors').html("");
            var formData = new FormData(this);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                url: "{{ route('add_new_size') }}",
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

                success: function(result) {

                    if (result.success) {
                        $('.success-notification .success-message').html(result.message);
                        $('.update-size .errors').html();
                        clearUpdateSizeModal();
                        $('.update-size').modal('hide');
                        $(".success-notification").modal("show");


                    }
                },
                error: function(jqXhr, json,
                    errorThrown) { // this are default for ajax errors 
                    var errors = jqXhr.responseJSON;
                    var errorsHtml = '';
                    $.each(errors['errors'], function(index, value) {
                        errorsHtml +=
                            '<ul ><li  style="color: red">' +
                            value[0] + '</li></ul>';
                    });
                    $('.update-size .errors').html(`${errorsHtml}`);
                }

            });

        })



        $("#add_prod_color_form").submit(function(e) {
            e.preventDefault();
            $('.errors').html("");
            var formData = new FormData(this);
            let TotalFiles = $('#images')[0].files.length; //Total files
            let files = $('#images')[0];
            for (let i = 0; i < TotalFiles; i++) {
                formData.append('images' + i, files.files[i]);
            }


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                url: "{{ route('addColor') }}",
                type: "POST",
                data: formData, // serializes the form's elements.
                dataType: 'json',
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
                    $(".collection select").prop("selectedIndex", 0);
                    $(".collection input").val("");
                    if (data.success) {

                        $(".add-color-form").modal('hide');
                        $(".success-message").html(`${data.message}`)
                        $(".success-notification").modal("show")


                    }



                },
                error: function(jqXhr, json,
                    errorThrown) { // this are default for ajax errors 
                    var errors = jqXhr.responseJSON;
                    var errorsHtml = '';
                    $.each(errors['errors'], function(index, value) {
                        errorsHtml +=
                            '<ul ><li  style="color: red">' +
                            value[0] + '</li></ul>';
                    });
                    $('.errors').html(`${errorsHtml}`);

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

        function viewImages(color_id, product_id) {
            alert(color_id);
        }

        $(document).on("click", '.delete-size-btn', function() {

            var index = $(this).index('.delete-size-btn');
            var size_id = $('.size-collection select').eq(index).val();
            var quantity = $('.size-collection p').eq(index).html();
            var product_id=$('.new-size #product_id').val();
            var color_id=$('.new-size #color_id').val();

            var size = {
                "size_id": size_id,
                "quantity": quantity,
                "product_id":product_id,
                "color_id":color_id
            }

            sessionStorage.setItem("size",  JSON.stringify(size));
            $(".update-size").modal('hide');

            $(".delete-size-confirmation").modal('show');

            //  console.log(size);
        })

        $(".delete-size-confirmation .delete-size").on('click',function(){
           var size= sessionStorage.getItem("size");
           sessionStorage.clear();
           size=JSON.parse(size);
           jQuery.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                url: "{{ route('delete_size') }}",
                method: 'post',
                data: size,

                beforeSend: function() {

                    $(".spinner-circle").removeClass("display_none");
                    $(".spinner-circle").addClass("display_block")

                },

                complete: function() {
                    $(".spinner-circle").removeClass("display_block");
                    $(".spinner-circle").addClass("display_none")

                },

                success: function(result) {
                    if (result.success) {
                      $(".success-notification .success-message").html(result.message);
                      $(".delete-size-confirmation").modal("hide");
                      $(".success-notification").modal('show');
                    }



                },
            });

           
        })

        function updatesizes(color_id, product_id) {
            $('#submit_new_size #product_id').val(product_id);
            $('#submit_new_size #color_id').val(color_id);

            jQuery.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                url: "{{ route('update_size_form') }}",
                method: 'post',
                data: {

                    color_id: color_id,
                    product_id: product_id

                },


                success: function(result) {
                    if (result.success) {
                        sizes = result.sizes;
                        products = result.products;

                        data = '';
                        for (var i = 0; i < products.length; i++) {
                            data = data +
                                "<div style='border-bottom:1px solid red' class='row pt-2 pb-2 '><div class='col-md-4'> <div class = 'size' ><select class='form-control' value=" +
                                products[i].size_id + "><option>" + sizes[i] +
                                "</option></select></div></div><div class='col-md-4'> <div class ='quantity'><p style='text-align:center'>" +
                                products[i].quantity +
                                "</p> </div></div><div class = 'col-md-4'><div class = 'delete-btn'><button class='btn btn-danger delete-size-btn'>Delete</button> </div></div></div>"

                        };
                        $('.size-collection').append(data);
                        $('.update-size').modal('show');
                    }

                }
            });

        }

        function deleteColor(color_id, product_id) {
            $(".delete-color-confirmation").modal('show');
            $('.delete-color-confirmation #color_id').val(color_id);
            $(".delete-color-confirmation #product_id").val(product_id);
        }

        function clearUpdateSizeModal() {
            $('.size-collection').html('');

        }

        $(".update-size .btn-close").click(function() {
            clearUpdateSizeModal();
        });
        $('.update-size .dismissModal').click(function() {
            clearUpdateSizeModal();
        })





        $('.delete_color_btn').on('click', function() {
            jQuery.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                url: "{{ route('delete-product-color') }}",
                method: 'post',
                data: {
                    color_id: $('.delete-color-confirmation #color_id').val(),

                    product_id: $(".delete-color-confirmation #product_id").val()

                },

                beforeSend: function() {

                    $(".spinner-circle").removeClass("display_none");
                    $(".spinner-circle").addClass("display_block")

                },

                complete: function() {
                    $(".spinner-circle").removeClass("display_block");
                    $(".spinner-circle").addClass("display_none")

                },

                success: function(result) {
                    if (result.success) {
                        location.reload();
                    }



                },
            });


        });
    </script>
@endsection
