@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="cart-page">
            <h5 class="text-center mb-5">รายการสินค้าในตะกร้า</h5>
            <div class="onlynum"></div>
            @if (session('addcartfail'))
                <div class="alert alert-danger alert-dismissible text-center mt-5" role="alert">
                    {{ session()->get('addcartfail') }}
                </div>
            @endif
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col" >สินค้า</th>
                        <th scope="col" style="width: 10%;" class="text-end">ราคา</th>
                        <th scope="col" style="width: 5%;">จำนวน</th>
                        <th class="col" style="width: 10%;" class="text-end">ราคารวม</th>
                        <th style="width: 10%;"></th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @if (session('cart'))
                        
                        @foreach (session('cart') as $id => $detail)
                            @php $total += $detail['price'] * $detail['qty'] @endphp

                            <tr data-id="{{ $id }}">
                                <td>
                                    {{ $detail['product_name'] }}
                                    <div class="cart-img mt-2">
                                        <img src="{{ url($detail['thumbnail']) }}" alt="">
                                    </div>
                                </td>
                                <td class="text-end">
                                    {{ number_format($detail['price']) }} ฿
                                </td>
                                <td class="text-center">
                                    <input type="text" name="" value="{{ $detail['qty'] }}" data-qty="{{ $detail['qty'] }}" class="form-control cart-update text-center">
                                </td>
                                <td class="text-end">
                                    {{ number_format($detail['price'] * $detail['qty']) }} ฿
                                </td>
                                <td class="action text-center">
                                    <button class="btn btn-danger btn-sm cart_remove">
                                        ลบ
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    @endif
                    
                </tbody>
                <tfoot>
                    <tr>
                        @if(count((array) session('cart')))
                            <td colspan="6" class="text-end"><strong><h4>{{ number_format($total) }} ฿</h4></strong></td>
                        @else
                            <td colspan="6" class="text-center"><div class="p-3 text-danger">ยังไม่ได้เลือกสินค้า</div></td>
                        @endif

                    </tr>
                    <tr>
                        <td colspan="6" class="text-end">
                            <a href="{{ route('home') }}" class="btn btn-danger">ดูสินค้าเพิ่มเติม</a>
                            @if(count((array) session('cart')))
                                <a href="{{ route('cart.checkout') }}" class="btn btn-success">ดำเนินการชำระเงิน</a>
                            @endif
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(function(){
            $('.cart_remove').on('click', function(){
                let ele = $(this);

                if(confirm("ยืนยันการลบ?")){
                    $.ajax({
                        url: '{{ route("remove.cart") }}',
                        method: 'DELETE',
                        data : {
                            _token: '{{ csrf_token() }}',
                            id: ele.parents("tr").attr('data-id')
                        },
                        success: function(res){
                            window.location.reload();
                        }
                    });
                }
            });

            $('.cart-update').on('change',function(){
                let ele = $(this);
                let val = $(this).val();
                let oldval = $(this).attr('data-qty');
                console.log(oldval);
                if($.isNumeric(val)){
                    $.ajax({
                        url: '{{ route("update.cart") }}',
                        method: 'PUT',
                        data : {
                            _token: '{{ csrf_token() }}',
                            id: ele.parents("tr").attr('data-id'),
                            qty: val
                        },
                        success: function(res){
                            window.location.reload();
                        }
                    });
                }else{
                    ele.val(oldval)
                    $('.onlynum').html('<small class="alert alert-danger alert-dismissible text-center d-block">* เฉพาะตัวเลขเท่านั้น</small>');

                    setTimeout(() => {
                        $('.onlynum').html('');
                    }, 1500);
                }
            });
        });
    </script>
@endsection