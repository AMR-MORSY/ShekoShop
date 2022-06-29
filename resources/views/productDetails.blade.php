@extends('layouts.master')
@section('content')
    {{-- <section id="product-details"> --}}

    {{-- <div class="container"> --}}
    {{-- <div class="row"> --}}
    {{-- <div class="col-md-6"> --}}
    {{-- <livewire:vertical-carousel :images="$images" /> --}}
    {{-- </div> --}}
    {{-- <div class="col-md-6"> --}}
    {{-- <livewire:colors :colors="$colors" /> --}}

    {{-- </div> --}}
    {{-- </div> --}}
    {{-- </div> --}}

    {{--  --}}
    {{-- </section> --}}
    <section id="vertical-carosel">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="vertical-carosel-container">


                        <livewire:vertical-carousel :images="$images" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="prodcut-name">
                        <p>{{ $product->product_name }}</p>

                    </div>
                    <div class="prodcut-long-desc">
                        <p>{{ $product->product_longDesc }}</p>

                    </div>
                    <div>
                        <p>Available Colors:</p>
                        <livewire:colors :colors="$colors" />

                    </div>
                    <div>
                        <p>Available Sizes:</p>
                        <livewire:sizes :sizes="$sizes" />

                    </div>

                    <div class="features">
                        <div class="row">
                            {{-- <div class="col-md-6"> --}}
                                {{-- @role('admin') --}}
                                {{-- <a href="{{route('product_delete',['product'=>$product->id])}}" class="btn btn-danger">Delete</a> --}}
                                {{-- @endrole --}}
                            {{-- </div> --}}
                            <div class="col-md-6">
                                @role('admin')
                                <a href="{{route('product_update',['product'=>$product->id])}}" class="btn btn-primary">Update</a>
                                
                                @endrole
                            
                               
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
