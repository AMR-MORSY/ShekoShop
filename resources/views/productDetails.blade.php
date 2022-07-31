@extends('layouts.master')
@section('content')
    <section id="vertical-carosel">
        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    @if (isset($images))
                        <div class="vertical-carosel-container">


                            <livewire:vertical-carousel :images="$images" />
                        </div>
                    @else
                        <div class="facefront-container ">
                            <img src="{{ $facefrontImage }}" class="w-100" alt="">
                        </div>
                    @endif

                </div>
                <div class="col-md-6">
                    <div class="prodcut-name">
                        <p>{{ $product->product_name }}</p>

                    </div>
                    <div class="prodcut-long-desc">
                        <p>{{ $product->product_longDesc }}</p>

                    </div>
                 
                        <div>
                            @if (isset($colors))
                                <p>Available Colors:</p>
                                <livewire:colors :colors="$colors" />
                            @endif


                        </div>
                        <div>
                            @if (isset($sizes))
                                <p>Available Sizes:</p>
                                <livewire:sizes :sizes="$sizes" />
                            @endif


                        </div>

                        <div class="features">
                            <div class="row">

                                <div class="col-md-6">
                                    @role('admin')
                                        <a href="{{ route('product_update', ['product' => $product->id]) }}"
                                            class="btn btn-primary">Update</a>
                                    @endrole


                                </div>
                            </div>
                        </div>

                        <div class="counter-container">
                            <livewire:counter wire:key='productdetailscounter' counter_host="product_details" />
                        </div>

                        @if (isset($colors))
                            <div class="add-cart-button">

                                <livewire:cart-button :product="$product->id" :colors="$colors" :sizes="$sizes" />
                            </div>
                        @else
                            <div class="add-cart-button">

                                <livewire:cart-button :product="$product->id" />
                            </div>
                        @endif
                 



                    {{-- <livewire:cart /> --}}

                </div>
            </div>
        </div>
    </section>
@endsection
