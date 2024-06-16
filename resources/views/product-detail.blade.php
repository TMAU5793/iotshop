@extends('layouts.app')

@section('content')

    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-12 bread-crumbs">
                    <small><a href="{{ route('home') }}" class="link"> หน้าหลัก </a></small>
                    <small>-> {{ $product->name }}</small>
                </div>
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ $product->thumbnail }}" alt="{{ $product->name }}" /></div>
                <div class="col-md-6">
                    <div class="small mb-1">{{ $product->code }}</div>
                    <h1 class="display-5 fw-bolder">{{ $product->name }}</h1>
                    <div class="fs-5">
                        {{-- <span class="text-decoration-line-through">$45.00</span> --}}
                        <span>{{ number_format($product->price) }} ฿</span>
                    </div>
                    <small class="d-block">จำนวน <strong>{{ $product->stock }}</strong> ชิ้น</small>
                    <p class="lead mt-5">{!! $product->description !!}</p>
                    
                    @if($product->stock)
                        <form id="frm-qty" action="{{ route('product.addcars') }}" method="POST">
                            @csrf
                            <input type="submit" hidden />
                            <input type="hidden" name="hd_id" value="{{ $product->id }}">
                            <div class="d-flex">
                                <input class="form-control text-center me-3" id="inputQty" name="qty" type="text" value="1" style="max-width: 3rem" onchange="checkedNum(this)"/>
                                <button id="btn-addcart" class="btn btn-outline-dark flex-shrink-0" type="button">
                                    <i class="bi-cart-fill me-1"></i>
                                    เพิ่มตะกร้า
                                </button>
                            </div>
                        </form>
                    @else
                        <button class="btn btn-danger">สินค้าหมดชั่วคราว</button>
                    @endif
                    <div class="onlynum"></div>

                    @if (session('addcartfail'))
                        <div class="alert alert-danger alert-dismissible text-center mt-5" role="alert">
                            {{ session()->get('addcartfail') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">สินค้าใกล้เคียง</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">

                @foreach ($product_relate as $relate)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ $relate->thumbnail }}" alt="{{ $relate->name }}" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $relate->name }}</h5>
                                    <!-- Product price-->
                                    <span>{{ number_format($relate->price) }} ฿</span>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{ route('product.detail', $relate->slug) }}">ดูเพิ่มเติม</a></div>
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
        function checkedNum (input){
            let val = input.value;
            if(!$.isNumeric(val)){
                input.value = 1;
                $('.onlynum').html('<small class="text-danger">* เฉพาะตัวเลขเท่านั้น</small>');

                setTimeout(() => {
                    $('.onlynum').html('');
                }, 1500);
            }
        }

        $('#btn-addcart').on('click',function(){
            let qty = $('#inputQty').val();
            if($.isNumeric(qty)){
                $('#frm-qty').submit();
            }
        });
    </script>
@endsection