<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تسجيل الدخول</title>

    <!-- Example usage of the Arabic CSS or main CSS depending on locale -->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/ar.css') }}">

    <!-- Font Awesome (icons) -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Example custom fonts -->
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background: #f4f4f4;
        }
        .material-half-bg, .cover {
            background-color: #fff !important;
        }
        .material-half-bg {
            height: 100vh;
        }
        .cover {
            height: 50vh;
        }
        .login-content .logo {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .login-box {
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            margin: 0 auto;
            min-width: 320px;
            max-width: 420px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background-color: #46885e;
            border-color: #46885e;
        }
        .login-head {
            margin-bottom: 20px;
        }
        .link-to-website {
            text-align: center;
            margin-top: 15px;
        }
        .link-to-website a {
            color: #46885e;
            text-decoration: underline;
        }
    </style>
</head>
<body>

@if ($errors->any())
    @foreach ($errors->all() as $error)
        @php
            toastr()->error($error);
        @endphp
    @endforeach
@endif

<section class="container row m-auto">
       <div style="background: #ffffff;  margin-top: 27px;border-radius: 10px;padding: 36px;" class="card-body offset-4  col-md-5  shadow-sm ">
           <div class="logo text-center">
               <img height="100px" src="{{ asset('logo.png') }}" alt="Logo">
           </div>
           <form id="loginForm" class="login-form" action="{{ route('login') }}" method="POST">
               @csrf
               <h3 class="login-head text-center">
                   <i class="fa fa-lg fa-fw fa-user"></i> {{ __('Login') }}
               </h3>
               <div class="form-group">
                   <label class="control-label">نوع المستخدم</label>
                   <select name="type" class="form-control">
                       <option value="admin">مدير</option>
                       <option value="doctor">طبيب</option>
                       <option value="pharmacist">صيدلي</option>
                       <option value="patient">مريض</option>
                   </select>
               </div>

               <!-- Email or Phone -->
               <div class="form-group">
                   <label class="control-label">{{ __('البريد الإلكتروني أو رقم الهاتف') }}</label>
                   <input autocomplete="off" class="form-control" type="text" name="login" value="{{ old('login') }}" autofocus>
               </div>

               <!-- Password -->
               <div class="form-group">
                   <label class="control-label">{{ __('كلمة المرور') }}</label>
                   <input autocomplete="off" class="form-control" type="password" name="password">
               </div>

               <!-- Stay Signed In? -->
               <div class="form-group">
                   <div class="utility d-flex justify-content-between">
                       <div class="animated-checkbox">
                           <label>
                               <input type="checkbox" name="remember">
                               <span class="label-text">{{__('ابق متصلاً')}}</span>
                           </label>
                       </div>
                       <!-- Forgot Password Placeholder -->
{{--                       <p class="semibold-text mb-2">--}}
{{--                           <a href="#" data-toggle="flip">{{ __('Forgot Password?') }}</a>--}}
{{--                       </p>--}}
                   </div>
               </div>

               <!-- Submit -->
               <div class="form-group btn-container">
                   <button type="submit" class="btn btn-primary btn-block">
                       <i class="fa fa-sign-in fa-lg fa-fw"></i> {{ __('Login') }}
                   </button>
               </div>

               <!-- Link back to Website -->
               <div class="link-to-website">
                   <a href="{{ route('home') }}">العودة إلى الموقع الرئيسي</a>
               </div>
           </form>
           <form class="forget-form" action="#" style="display: none;">
               <h3 class="login-head">
                   <i class="fa fa-lg fa-fw fa-lock"></i> {{ __('Forgot Password ?') }}
               </h3>
               <div class="form-group">
                   <label class="control-label">{{__('E-Mail')}}</label>
                   <input class="form-control" type="text" placeholder="Email">
               </div>
               <div class="form-group btn-container">
                   <button class="btn btn-primary btn-block">
                       <i class="fa fa-unlock fa-lg fa-fw"></i>{{__('RESET')}}
                   </button>
               </div>
               <div class="form-group mt-3">
                   <p class="semibold-text mb-0">
                       <a href="#" data-toggle="flip">
                           <i class="fa fa-angle-left fa-fw"></i> {{ __('Back to Login') }}
                       </a>
                   </p>
               </div>
           </form>
       </div>
</section>

<!-- Essential JS for the page (adjust paths as needed) -->
<script src="{{ asset('admin/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('admin/js/popper.min.js') }}"></script>
<script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/js/main.js') }}"></script>
{{--<script src="{{ asset('admin/js/plugins/pace.min.js') }}"></script>--}}

<script type="text/javascript">
    // Toggle between login and forgot password forms
    $('[data-toggle="flip"]').click(function() {
        $('.login-box .login-form').toggle();
        $('.login-box .forget-form').toggle();
        return false;
    });
</script>
</body>
</html>
