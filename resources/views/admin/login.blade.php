<!DOCTYPE html>
<html lang="en">

<head>

   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
   <meta name="description" content="">
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>ลงชื่อใช้งาน</title>
   <link rel="icon" type="image/x-icon" href="{{ url('assets/images/favicon.png') }}">

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
   <link rel="stylesheet" href="{{ url('assets/css/adminStyle.css') }}">
</head>

<body class="bg-dark">

   <div class="container login-page">

        <!-- Outer Row -->
        <div class="card position-absolute top-50 start-50 translate-middle">
            <div class="card-body p-0">
                <div class="p-5">
                    <div class="text-center mb-4">
                        <h1 class="h4 text-gray-900">ลงชื่อเข้าใช้งาน</h1>
                        @if (session('error'))
                            <span class="text-danger">{{ session('error') }}</span>
                        @endif
                    </div>
                    <form class="user" action="{{ route('auth.admin') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="text" name="username" class="form-control" placeholder="บัญชีผู้ใช้">
                            <small class="text-danger">{{ $errors->first('username') }}</small>
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" name="password" class="form-control" placeholder="รหัสผ่าน">
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                        </div>
                        <button class="btn btn-primary d-block m-auto border-0">
                            เข้าสู่ระบบ
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>