<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhâp/Đăng ký</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    @if(session('suc'))
    <script>
        Swal.fire({
            icon: 'success',
            title: "{{ session('suc') }}",
            showConfirmButton: false,
        });
    </script>
    @endif
    @if(session('err'))
    <script>
        Swal.fire({
            icon: 'error',
            title: "{{ session('err') }}",
            showConfirmButton: false,
        });
    </script>
    @endif
    <div class="container my-5 d-flex justify-content-center">
        <div class="col-md-4">
            <!-- Pills navs -->
            <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="tab-login" data-bs-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Đăng nhập</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="tab-register" data-bs-toggle="pill" href="#pills-register" role="tab" aria-controls="pills-register" aria-selected="false">Đăng ký</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                    <div class="text-center mb-3">
                        <p>Đăng nhập với:</p>
                        <!-- <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-facebook-f"></i>
                        </button> -->
                        <button class="btn btn-link btn-floating mx-1" onclick="window.location='<?php echo route('google.login') ?>'">
                            <i class="fab fa-google"></i>
                        </button>
                    </div>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <p class="text-center">Hoặc:</p>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="loginName">Email</label>
                            <input type="email" id="loginName" name="email" class="form-control" placeholder="Nhập email" />
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="loginPassword">Mật khẩu</label>
                            <input type="password" class="form-control" id="loginPassword" name="matkhau" placeholder="Nhập mật khẩu">
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-6 d-flex justify-content-center">
                            </div>
                            <div class="col-md-6 d-flex justify-content-center">
                                <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
                            </div>
                        </div>
                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-primary btn-block mb-4">Đăng nhập</button>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
                    <div class="text-center mb-3">
                        <p>Đăng nhập với:</p>

                        <button class="btn btn-link btn-floating mx-1" onclick="window.location='<?php echo route('google.login') ?>'">
                            <i class="fab fa-google"></i>
                        </button>
                    </div>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <p class="text-center">Hoặc:</p>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="registerName">Tên</label>
                            <input type="text" class="form-control" id="registerName" name="ten" placeholder="Nhập họ và tên">
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="registerEmail">Email</label>
                            <input type="email" class="form-control" id="registerEmail" name="email" placeholder="Nhập email">
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="registerPassword">Mật khẩu</label>
                            <input type="password" class="form-control" id="registerPassword" name="matkhau" placeholder="Nhập mật khẩu">
                        </div>

                        <!-- Repeat Password input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="registerRepeatPassword">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" id="confirmPassword" name="matkhau_confirmation" placeholder="Nhập lại mật khẩu">
                        </div>
                        <!-- <div class="form-check d-flex justify-content-center mb-4">
                            <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked aria-describedby="registerCheckHelpText" />
                            <label class="form-check-label" for="registerCheck">
                                I have read and agree to the terms
                            </label>
                        </div> -->
                        <div class="text-center mb-3">
                            <button type="submit" class="btn btn-primary btn-block mb-4">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
