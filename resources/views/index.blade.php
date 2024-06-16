@extends('layouts.app')

@section('content')

    @if (session('checkedout'))
        <div class="alert alert-success alert-dismissible text-center mt-5" role="alert">
            {{ session()->get('checkedout') }}
        </div>
    @endif
    {{-- Banner Section --}}
    <div class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">ioT Shopping</h1>
                <p class="lead fw-normal text-white-50 mb-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
            </div>
        </div>
    </div>

    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-3 row-cols-xl-4 justify-content-center">

                @foreach ($products as $product)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <div class="product-action position-absolute end-0">

                                @if ($product->stock)
                                    <a href="{{ route('product.addcart', $product->id) }}" class="btn btn-success"><small>เพิ่มตะกร้า</small></a>
                                @else
                                    <button class="btn btn-danger"><small>สินค้าหมด</small></button>
                                @endif
                                
                            </div>
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ url($product->thumbnail) }}" alt="{{ $product->name }}" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $product->name }}</h5>
                                    <!-- Product price-->
                                    <span>{{ $product->price }} บาท</span>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="{{ route('product.detail', $product->slug) }}">ดูเพิ่มเติม</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                
            </div>
        </div>
    </section>

@endsection

@section('script')
    <script>
        
       $(function() {
            setTimeout(function() {
                $('.alert-success').remove();
            }, 1000);
        });

    </script>
@endsection