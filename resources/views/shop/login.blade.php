<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingreso de usuarios - {{ session("infoComercio.nombre") }}</title>

    <!-- Hojas de estilo -->
    <link rel="stylesheet" href="{{ config('constants.shop_css') }}style.css">
    <link rel="stylesheet" href="{{ config('constants.framework_css') }}alert.css">

    <style>
        .login-container {
            margin:             0;
            padding:            0;
            height:             100vh;
            display:            flex;
            justify-content:    center;
            align-items:        center;
        }

        .login-panel {
            display:            flex;
            width:              100%;
            max-width:          600px;
            margin:             0 20px;
            background-color:   white;
            min-height:         400px;
            border-radius:      10px;
            box-shadow:         0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
        }

        .left-panel, .right-panel {
            display:                flex;
            flex-direction:         column;
            justify-content:        center;
            width:                  50%;
            padding:                20px;
            box-sizing:             border-box;
        }

        .left-panel {
            border-radius:          10px 0 0 10px;
            justify-content:        space-between;
        }

        .left-panel h1 {
            text-align:             center;
        }

        .left-panel p {
            margin:                 0;
        }
        
        .right-panel {
            border-radius:          0 10px 10px 0;
            text-align:             center;
            background:             -webkit-linear-gradient(to right, #FF4B2B, #FF416C);
            background:             linear-gradient(to right, #FF4B2B, #FF416C);
            background-repeat:      no-repeat;
            background-size:        cover;
            background-position:    0 0;
            color:                  white;
        }

        h1, h2 {
            margin: 0;
        }

        @media (max-width: 600px) {

            .login-panel {
                flex-direction: column;
                margin: 0 50px;
            }

            .right-panel {
                display: none;
            }

            .left-panel {
                flex: 1;
                width: 100%;
            }

        }
    </style>

    </head>
    <body>

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert danger">
                    <div>{{$error}}</div>
                    <div class="closebtn" onclick="this.parentElement.style.display='none';">&times;</div>
                </div>
            @endforeach
        @endif

        @if (session("success"))
            <div class="alert success">
                <div>{{session("success")}}</div>
                <div class="closebtn" onclick="this.parentElement.style.display='none';">&times;</div>
            </div>
        @endif

        @if (session("error"))
            <div class="alert danger">
                <div>{{session("error")}}</div>
                <div class="closebtn" onclick="this.parentElement.style.display='none';">&times;</div>
            </div>
        @endif

        <div class="login-container">
            <div class="login-panel">
                <div class="left-panel">
                    <h1>Login</h1>
                    <p>{{ __('general.register_msg') }} <a class="register-link" href="/shop/register">{{ __('general.register_link') }}</a></p>
                    <div class="input-group">
                        <label>
                            Usuario o email
                            <input form="form-login" type="text" name="username" required maxlength="16">
                        </label>
                        <label>
                            Password
                            <input form="form-login" type="password" name="password" required maxlength="16">
                        </label>
                        <div class="radio-fix">
                            <input form="form-login" type="checkbox" name="check_remember">
                            <label>Recordarme</label>
                        </div>
                    </div>
                    <a class="password-recovery-link" href="/shop/recovery">{{ __('general.forgot_password_msg') }}</a>
                    <button form="form-login" type="submit" class="btn-primary">{{ __('general.login_button') }}</button>
                </div>
                <div class="right-panel">
                    <div>
                        <h2>{{ session("infoComercio.nombre") }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <form id="form-login" method="post" autocomplete="off">@csrf</form>
        <form id="form-guest" method="post" autocomplete="off" action="{{ route('login.guest') }}">@csrf</form>
    </body>
</html>
