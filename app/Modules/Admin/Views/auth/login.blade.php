<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title> {{ config('app.name', 'ILAOne.co.uk') }} | Login</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(Session::has('shortcut_icon'))
    <?php  $shortcut_icon = Session::get('shortcut_icon'); ?>
    <link rel="shortcut icon" href="{{URL::to('uploads/generel_file/')}}/{{$shortcut_icon->value}}"/>
    @endif
    <!-- Bootstrap Core Css -->
    <link href=" {{ asset('backend/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href=" {{ asset('backend/css/style.css') }}" rel="stylesheet">
</head>
{{-- <body class="login-page" style="background-image: url(logo/login_back_image.jpg);">
 --}}
 <body class="login-page">
    <div class="login-box">
        
       <div class="card">
        <div class="body">
         
            <form action="{{ URL::to('do_login') }}" method="POST" id="login"  class="margin-bottom-0">
                @csrf
                <div class="msg">Sign in to start your session</div>
                


                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">person</i>
                    </span>
                    <div class="form-line">
                        <input placeholder="example@gmail.com" id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} text required email" name="email" value="{{ old('email') }}" required autofocus />
                        @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                      <input id="password" type="password" placeholder="Write Your Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required minlength="6" maxlength="20">

                      @if ($errors->has('password'))
                      <span class="invalid-feedback">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-8 p-t-5">
                 
                </div>
                <div class="col-xs-4">
                    <button class="btn btn-block bg-blue waves-effect" type="submit">SIGN IN</button>
                </div>
            </div>
            
            <div>
             @include('Admin::error.msg')

         </div>
     </form>
 </div>
</div>
</div>

<!-- Jquery Core Js -->
<script src=" {{ asset('backend/plugins/jquery/jquery.min.js') }} "></script>

<!-- Bootstrap Core Js -->
<script src=" {{ asset('backend/plugins/bootstrap/js/bootstrap.js') }} "></script>


<!-- Custom Js -->
<script src=" {{ asset('backend/js/admin.js') }} "></script>
<script src=" {{ asset('backend/js/pages/examples/sign-in.js') }} "></script>
<script>
    $(function() {
        // highlight
        var elements = $("input[type!='submit'], textarea, select");
        
        $("#login").validate({
          rules:{
            email:{
              required:true,
              email:email
          },
          password:{
              required:true
          }
          
      },
      messages:{
        email:'Please enter valid email',
        password:'Please enter valid password'
    }
});
    });
</script>
</body>

</html>