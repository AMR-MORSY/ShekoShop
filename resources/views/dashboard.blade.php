@extends('layouts.master')
@section('content')
    <section id="dashboard">

        <div class="container">
            <div class="row">
                @livewire('dashboard.addproductform', ['categories' => $categories, 'types' => $types, 'devisions' => $devisions])

                @livewire('dashboard.add-color-notification')
                @livewire('dashboard.add-stock')
                <div class="col-lg-6">
                    <div class="title">
                        <h3>Search Product</h3>
                    </div>

                    @livewire('search-product')

                    {{-- <div>
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

                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')
    <script>
        // $(document).ready(function() {
        //     $('#form-submit').on('click', function() {

        //         var collection = document.querySelectorAll('.collection');

        //         var collectionLength = collection.length;

        //         // alert(collectionLength);

        //         for (var x = 0; x < collectionLength; x++) {
        //             var sizes_collection = [];
        //             var quantities_collection = [];
        //             $(`.size${x}`).each(function() {

        //                 if (this.checked) {
        //                     sizes_collection.push($(this).val());
        //                 }

        //             })
        //             $(`.size-collection${x}`).val(sizes_collection);
        //             $(`.quantity${x} .counter`).each(function() {

        //                 var int_val = parseInt($(this).html());


        //                 quantities_collection.push(int_val);


        //             })
        //             $(`.quantity-collection${x}`).val(quantities_collection);





        //         }

        // list.forEach((el) => {
        //     el.addEventListener("click", (e) => {
        //         //code that affects the element you click on

        //         collection.filter((x) => x != el).forEach((otherEl) => {
        //             //code that affects the other elements you didn't click on
        //             otherEl.style.display = "none";
        //         });
        //     });
        // });



        // var quant = $('.quantity0 .counter').html();

        // console.log(quant);



        // });



        // window.addEventListener('contentChanged', (e) => {
        // var collection =document.querySelectorAll('.collection') ;
        // var list =document.querySelectorAll(".close") ;
        // for (let i = 0; i < list.length; i++) {
        //     list[i].addEventListener("click", function() {
        //         // collection[i].style.display = 'none';
        //         //  alert(`hello${list[i]}`);
        //         collection[i].parentNode.removeChild(collection[i])
        //     });
        // }

        // });












        // })
    </script>
@endsection
