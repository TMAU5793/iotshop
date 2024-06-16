@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="cart-page">
            <h5 class="text-center mb-5">ข้อมูลลูกค้า</h5>
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route('comfirmcheckout') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">ชื่อ <small >* จำเป็น</small></label>
                                <input type="text" name="name" class="form-control">
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">นามสกุล <small >* จำเป็น</small></label>
                                <input type="text" name="lastname" class="form-control">
                                <small class="text-danger">{{ $errors->first('lastname') }}</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">อีเมล <small >* จำเป็น</small></label>
                                <input type="email" name="email" class="form-control">
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">เบอร์โทร <small >* จำเป็น</small></label>
                                <input type="text" name="phone" class="form-control">
                                <small class="text-danger">{{ $errors->first('phone') }}</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">ที่อยู่ <small >* จำเป็น</small></label>
                                <input type="text" name="address" class="form-control">
                                <small class="text-danger">{{ $errors->first('address') }}</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">จังหวัด <small >* จำเป็น</small></label>
                                <input type="text" name="province" class="form-control">
                                <small class="text-danger">{{ $errors->first('province') }}</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">อำเภอ/เขต <small >* จำเป็น</small></label>
                                <input type="text" name="district" class="form-control">
                                <small class="text-danger">{{ $errors->first('district') }}</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">ตำบล/แขวง <small >* จำเป็น</small></label>
                                <input type="text" name="subdistrict" class="form-control">
                                <small class="text-danger">{{ $errors->first('subdistrict') }}</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">รหัสไปรษณีย์ <small >* จำเป็น</small></label>
                                <input type="text" name="postcode" class="form-control">
                                <small class="text-danger">{{ $errors->first('postcode') }}</small>
                            </div>
                            
                        </div>
                        <div class="text-center mt-5">
                            <a href="{{ route('product.cart') }}" class="btn btn-warning">ย้อนกลับ</a>
                            <button type="submit" class="btn btn-success">ยืนยันการชำระเงิน</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="card p-4 mt-4">
                        <h5 class="text-center">ข้อมูลสินค้า</h5>
                        <div class="card-body">
                            @php $total = 0 @endphp
                            @if (session('cart'))
                                
                                @foreach (session('cart') as $id => $detail)
                                    @php $total += $detail['price'] * $detail['qty'] @endphp

                                    <div class="product-item">
                                        <div class="row">
                                            <div class="col-6">
                                                {{ $detail['product_name'] }}
                                            </div>

                                            <div class="col-6">
                                                <div class="text-end">
                                                    {{ $detail['price'] * $detail['qty'] }} บาท
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="row mt-3">
                                    <div class="col-6">
                                        <h5>รวมทั้งหมด</h5>
                                    </div>

                                    <div class="col-6">
                                        <div class="text-end">
                                            <h5><strong>{{ $total }} บาท</strong></h5>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(function(){
            
        });
    </script>
@endsection