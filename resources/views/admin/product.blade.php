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
                    <h1 class="h3 mb-2 text-gray-800">รายการสินค้า</h1>
                    <p></p>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <button class="btn btn-filter mr-2" data-toggle="modal" data-target="#filterModal">
                                        <i class="fas fa-search"></i>
                                        ค้นหา
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <form class="w-100" action="" method="POST">
                                                @csrf
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <span>ค้นหาข้อมูล</span>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" title="ปิดตัวกรอง">
                                                            <i class="fas fa-times-circle text-danger"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        
                                                        <input class="form-control" type="text" name="keyword" placeholder="ค้นหาโดยชื่อ, รหัสสินค้า">
                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">ยืนยัน</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('product.create') }}" class="btn btn-success pr-4 pl-4">เพิ่ม</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                       <tr>
                                          <th>รหัสสินค้า</th>
                                          <th>ชื่อสินค้า</th>
                                          <th>ราคา</th>
                                          <th>สินค้าคงเหลือ</th>
                                          <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                       @foreach ($data as $item)
                                       <tr>
                                           <td><strong>{{ $item->product_code }}</strong></td>
                                           <td>{{ $item->name }}</td>
                                           <td>{{ $item->price }}</td>
                                           <td>{{ $item->stock }}</td>
                                           <td class="tbl-action" style="text-align: center;">
                                            <a href="{{ url('admin/product/edit/' . $item->id) }}">
                                                <i class="fas fa-edit text-dark action-item mr-2" title="แก้ไขข้อมูล"></i>                                                        
                                            </a>
                                            <form id="frm_student{{ $item->id }}" action="{{ route('product.destroy', $item->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <i class="fas fa-trash cursor-pointer text-danger action-item" onclick="removeItem( {{ $item->id }} , 'frm_student{{ $item->id }}' )" title="ลบข้อมูล"></i>
                                            </form>
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