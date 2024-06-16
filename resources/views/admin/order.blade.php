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
                    <h1 class="h3 mb-2 text-gray-800">รายการสั่งซื้อ</h1>
                    <p></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                       <tr>
                                          <th style="width: 10%;">หมายเลขสั่งซื้อ</th>
                                          <th>ลูกค้า</th>
                                          <th>ราคา</th>
                                          <th style="width: 10%;"></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($data as $item)
                                       <tr>
                                           <td><strong>{{ $item->id }}</strong></td>
                                           <td>{{ $item->name.' '.$item->lastname }}</td>
                                           <td>{{ $item->total_price }}</td>
                                           
                                           <td class="tbl-action" style="text-align: center;">
                                                <a href="{{ route('order.detail', $item->orderId) }}">
                                                    <i class="fas fa-eye text-dark" title="รายละเอียด"></i>
                                                    รายละเอียด                                                        
                                                </a>

                                            </td>
                                       </tr>
                                   @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="paging-custom">
                        {{ $data->links() }}
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