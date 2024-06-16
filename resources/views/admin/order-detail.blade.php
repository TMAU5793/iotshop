@extends('admin.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success alert-dismissible text-center" role="alert">
            {{ session()->get('status') }}
        </div>
    @endif

    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('admin.sidebar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content" class="mt-5">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">หมายเลขสั่งซื้อ # {{ $data->id }}</h1>
                    <p>ชื่อลูกค้า : {{ $customer->name.' '.$customer->lastname  }}</p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                       <tr>
                                          <th>สินค้า</th>
                                          <th style="width: 10%;" class="text-end">จำนวน</th>
                                          <th style="width: 10%;" class="text-end">ราคา</th>
                                          
                                      </tr>
                                    </thead>
                                    <tbody>
                                      
                                        @foreach($orderlist as $list)
                                
                                            <tr>
                                                <td> {{ $list->name }} </td>
                                                <td class="text-end"> {{ $list->qty }} </td>
                                                <td class="text-end"> {{ $list->price }} </td>
                                            </tr>

                                        @endforeach
                                        <tr>
                                            <td colspan="3" style="text-align: right;"> รวมทั้งหมด <strong>{{ $data->total_price }} บาท</strong> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

@endsection

@section('script')
    <script>
        $(function() {
            setTimeout(function() {
                $('.alert-success').remove();
            }, 1000);
        });

        function removeItem(id, frmId) {
            if (confirm("ยืนยันการลบ")) {
                $('#' + frmId).submit();
            }
        }
    </script>
@endsection