<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập và Đăng ký</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        .container {
            max-width: 600px;
            margin-top: 50px;
        }

        .form-title {
            margin-bottom: 20px;
        }

        .form-section {
            margin-bottom: 40px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-section">
            <h2 class="form-title">Đăng nhập</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="loginEmail">Email</label>
                    <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Nhập email">
                </div>
                <div class="form-group">
                    <label for="loginPassword">Mật khẩu</label>
                    <input type="password" class="form-control" id="loginPassword" name="matkhau" placeholder="Nhập mật khẩu">
                </div>
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </form>
        </div>

        <div class="form-section">
            <h2 class="form-title">Đăng ký</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="registerName">Họ và tên</label>
                    <input type="text" class="form-control" id="registerName" name="ten" placeholder="Nhập họ và tên">
                </div>
                <div class="form-group">
                    <label for="registerEmail">Email</label>
                    <input type="email" class="form-control" id="registerEmail" name="email" placeholder="Nhập email">
                </div>
                <div class="form-group">
                    <label for="registerPassword">Mật khẩu</label>
                    <input type="password" class="form-control" id="registerPassword" name="matkhau" placeholder="Nhập mật khẩu">
                </div>
                <div class="form-group">
                    <label for="confirmPassword">Xác nhận mật khẩu</label>
                    <input type="password" class="form-control" id="confirmPassword" name="matkhau_confirmation" placeholder="Nhập lại mật khẩu">
                </div>
                <button type="submit" class="btn btn-success">Đăng ký</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


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
</body>

</html>
