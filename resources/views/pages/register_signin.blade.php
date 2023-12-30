<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('frontend/css/cssdangky.css')}}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Register-Login</title>
</head>

<body>
    <a href="{{route('trangindex')}}" style="color:red">Về trang chủ</a>
    @if(session('error'))
    <div class="alert alert-danger" style="text-align: center; color:red;">
        {{session('error')}}
    </div>
    @endif
    @if(session('successregister'))
    <div class="alert alert-success">
    </div>
    <script>
        swal({
            title: "{{ session('successregister') }}",
            icon: "success",
            button: "OK",
        });
    </script>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h1>Tạo tài khoản</h1>
                <input type="text" placeholder="Name" name="Name" required />
                <input type="email" placeholder="Email" name="Email" required />
                <input type="password" placeholder="Password" name="Password" required />
                <button>Đăng ký</button>
            </form>
        </div>
        @if($message=Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert"></button>
            <strong>{{$message}}</strong>
        </div>
        @endif
        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Đăng nhập</h1>
                <input type="email" placeholder="Email" name="Email_Login" required />
                <input type="password" placeholder="Password" name="Password_Login" required />
                <a href="#">Quên mật khẩu?</a>
                <button>Đăng nhập</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Bạn đã có tài khoản?</h1>
                    <p></p>
                    <button class="ghost" id="signIn">Đăng nhập ngay</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Bạn chưa có tài khoản?</h1>
                    <p></p>
                    <button class="ghost" id="signUp">Đăng ký ngay</button>
                </div>
            </div>
        </div>
    </div>

    <!-- <footer>
        <p>
            Created with <i class="fa fa-heart"></i> by
            <a target="_blank" href="https://florin-pop.com">Florin Pop</a>
            - Read how I created this and how you can join the challenge
            <a target="_blank" href="https://www.florin-pop.com/blog/2019/03/double-slider-sign-in-up-form/">here</a>.
        </p>
    </footer> -->
    <script src="{{asset('frontend/js/jsdangky.js')}}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>