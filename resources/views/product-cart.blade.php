@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="cart-page">
            <h5 class="text-center mb-5">รายการสินค้าในตะกร้า</h5>
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
                                    {{ $detail['price'] }}
                                </td>
                                <td class="text-center">
                                    <input type="number" name="" value="{{ $detail['qty'] }}" class="form-control cart-update">
                                </td>
                                <td class="text-end">
                                    {{ $detail['price'] * $detail['qty'] }}
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
                    <tr class="text-end">
                        <td colspan="6"><strong><h4>{{ $total }} บาท</h4></strong></td>
                    </tr>
                    <tr>
                        <td colspan="6" class="text-end">
                            <a href="{{ route('home') }}" class="btn btn-danger">ดูสินค้าเพิ่มเติม</a>
                            <a href="{{ route('cart.checkout') }}" class="btn btn-success">ดำเนินการชำระเงิน</a>
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
                // console.log(val);
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
            });
        });
    </script>
@endsection