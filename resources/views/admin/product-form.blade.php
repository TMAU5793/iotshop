@extends('admin/app')

@section('content')
    @if (session()->get('status'))
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
                    <h1 class="h3 mb-2 text-gray-800">ข้อมูลสินค้า</h1>
                    <p></p>

                    <form action="{{ route('product.'.$action) }}" method="POST" enctype="multipart/form-data">      
                     @csrf
                     <input type="hidden" name="hd_id" value="{{ (isset($data) ? $data->id : '') }}">
               
                     <div class="row">
                        <div class="col-xl-8">
                              <div class="card mb-4">
                                 <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">เพิ่มข้อมูล</h5> <small class="text-muted float-end"></small>
                                 </div>
                                 <div class="card-body">
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="product_code">รหัสสินค้า <small class="text-danger">* จำเป็น</small></label>
                                            <input type="text" class="form-control" id="product_code" name="product_code" placeholder="รหัสสินค้า" value="{{ (isset($data) ? $data->product_code : old('product_code')) }}" />
                                            <small class="text-danger">{{ $errors->first('product_code') }}</small>
                                         </div>

                                       <div class="col-md-6">
                                          <label class="form-label" for="name">ชื่อสินค้า <small class="text-danger">* จำเป็น</small></label>
                                          <input type="text" class="form-control" id="name" name="name" placeholder="ชื่อสินค้า" value="{{ (isset($data) ? $data->name : old('name')) }}" />
                                          <small class="text-danger">{{ $errors->first('name') }}</small>
                                       </div>
                                       
                                    </div>
                                    <div class="row mb-3">
                                       <div class="col-md-6">
                                          <label class="form-label">ราคาสินค้า (บาท) <small class="text-danger">* จำเป็น</small></label>
                                          <input type="text" class="form-control" name="price" placeholder="ราคาสินค้า" value="{{ (isset($data) ? $data->price : old('price')) }}" />
                                          <small class="text-danger">{{ $errors->first('price') }}</small>
                                       </div>
                                       <div class="col-md-6">
                                          <label class="form-label">สินค้าคงเหลือ (ชิ้น) <small class="text-danger">* จำเป็น</small></label>
                                          <input type="text" class="form-control" name="stock" placeholder="สินค้าคงเหลือ" value="{{ (isset($data) ? $data->stock : old('stock')) }}" />
                                          <small class="text-danger">{{ $errors->first('stock') }}</small>
                                       </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label" for="shortdesc">ข้อมูลแนะนำ</label>
                                        <textarea id="shortdesc" name="shortdesc" class="form-control" rows="3" placeholder="แนะนำสินค้าเบื้องต้น">{{ (isset($data) ? $data->shortdesc : old('shortdesc')) }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="description">รายละเอียด</label>
                                        <textarea id="description" name="description" class="form-control tinymce-editer" rows="3" placeholder="รายละเอียด">{{ (isset($data) ? $data->description : old('desc')) }}</textarea>
                                    </div>
                                 </div>
                              </div>
                        </div>
                        <div class="col-xl-4">
                           <div class="card">
                              <div class="card-header pb-0">
                                 <h5>สินค้า</h5>
                              </div>
                              <div class="card-body">
                                 <div class="mb-3">
                                    <label class="form-label">Slug URL <small class="text-danger">* จำเป็น</small></label>
                                    <input type="text" class="form-control" name="slug" placeholder="ตัวอย่าง : iot-product-a" value="{{ (isset($data) ? $data->slug : old('slug')) }}" />
                                    <small class="text-danger">{{ $errors->first('slug') }}</small>
                                 </div>
                                 <div class="thumbnail">
                                    <img src="{{ (isset($data->thumbnail)? url($data->thumbnail) : asset('assets/images/image-default.png')) }}" class="display-thumbnail">
                                    <small class="d-block mt-2">* ขนาดรูปที่แนะนำ 450 x 300 px</small>
                                    <div class="mb-3 mt-3 input-file-hidden">
                                       <label for="thumbnail" class="form-label btn btn-primary">เลือกไฟล์</label>
                                       <input class="form-control" type="file" name="thumbnail" id="thumbnail" onchange="readURL(this)" accept="image/*">
                                       <input type="hidden" name="hd_path" value="{{ (isset($data)? $data->thumbnail : '') }}">
                                    </div>
                                 </div>
                                 <div class="cb-switch">
                                    <div class="mb-2">การเผยแพร่</div>
                                    <input class="form-check-input" type="checkbox" id="cb_status" name="cb_status" {{ (isset($data) ? ($data->status =='1' ? 'checked' : '') : 'checked') }}>
                                    <label class="form-check-label d-block" for="cb_status"></label>
                                 </div>
                                 <div class="clearfix"></div>
                              </div>
                              <div class="card-footer">                  
                                 <button type="submit" class="btn btn-success">บันทึก</button>
                                 <a href="{{ route('admin.product') }}" class="btn btn-warning ms-3">ยกเลิก</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </form>

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
      $(function(){
         $('#addressText').on('click',function(){
            $('.address-info textarea').removeClass('d-none');
            $('.address-info input').addClass('d-none');
         });

         $('#addressLink').on('click',function(){
            $('.address-info textarea').addClass('d-none');
            $('.address-info input').removeClass('d-none');
         });
      });
   </script>

@endsection