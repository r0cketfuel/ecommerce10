<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
	<head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ingreso de usuarios - {{session("infoComercio.nombre")}}</title>
        
        <!-- Hojas de estilo -->
        <link rel="stylesheet"	href="{{config('constants.shop_css')}}style.css">
        <link rel="stylesheet"	href="{{config('constants.framework_css')}}alert.css">

        <!-- Scripts -->

        <style>
            .alert-container {
                margin: var(--containers-side-padding);
            }
    
            .main-frame .register-link {
                height: 				var(--controls-height);
                width: 					100%;
                cursor: 				pointer;
                box-sizing: 			border-box;
                font-size: 				13px;
                text-transform: 		uppercase;
                border: 				1px solid #6c757d;
                background-color: 		#6c757d;
                color: 					white;
                border-radius:          var(--controls-height);
                padding:                0;
                display:                flex;
                justify-content:        center;
                align-items:            center;
            }
    
            .main-frame {
                margin:                 0 auto;
                min-height:             500px;
                min-width:              300px;
                max-width:              400px;
                border:                 1px solid rgb(220,220,220);
                display:                flex;
                flex-flow:              column nowrap;
                background-color:       white;
                border-radius:          10px;
                box-shadow:             0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22);
    
                position:               absolute;
                left:                   50%;
                transform:              translateX(-50%);
    
                animation-fill-mode:    both;
                animation-name:         animate-top;
                animation-duration: 	0.75s;
    
            }
    
            .main-frame .password-recovery-link {
                display:                block;
                color:                  #007bff;
                text-align:             right;
            }
    
            .main-frame .top-frame,
            .main-frame .middle-frame,
            .main-frame .bottom-frame {
                padding:                20px;
            }
    
            .main-frame .top-frame {
                display:                flex;
                flex-flow:              column;
                justify-content:        center;
                align-items:            center;
                gap:                    10px;
                border-bottom:          1px solid rgb(220,220,220);
            }
            
            .main-frame .top-frame img {
                width:                  30%;
                object-fit:             contain;
            }
    
            .main-frame .middle-frame {
                display:                flex;
                flex-flow:              column;
                flex:                   1 1;
                border-bottom:          1px solid rgb(220,220,220);
            }
            
            .main-frame .middle-frame .input-group {
                display:                flex;
                flex-flow:              column;
                flex:                   1 1;
            }
    
            .main-frame h1 {
                margin:                 0;
                padding:                0;
                font-size:              18px;
                text-align:             center;
            }
    
            @keyframes animate-top
            {
                from {top: -100%; opacity: 0} to {top: 10%; opacity: 1}
            }
        </style>

    </head>
	<body id="top">
        <div class="main-container">

            @if ($errors->any())
                <div class="alert danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session("success"))
                <div class="alert success">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    {{session("success")}}
                </div>
            @endif

            @if (session("error"))
                <div class="alert danger">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    {{session("error")}}
                </div>
            @endif

            <div class="main-frame">
                <div class="top-frame">
                    <img src="{{config('constants.images')}}/gear.jpg" alt="gear">
                    <h1>{{session("infoComercio.nombre")}}</h1>
                    <h2>Panel de administración</h2>
                </div>
                <div class="middle-frame">
                    <div class="input-group">
                        <label>Usuario<input form="form-login" type="text" name="username" value="devadmin"></label>
                        <label>Password<input  form="form-login" type="password" name="password" value="12345678"></label>
                        <div class="flex justify-between">
                            <div class="radio-fix">
                                <input type="checkbox" name="check_remember"><label>Recordarme</label>
                            </div>
                            <a class="password-recovery-link" href="#">Recuperar contraseña</a>
                        </div>
                        <div style="flex: 1 1;"></div>
                        <button form="form-login" type="submit" class="btn-primary btn-rounded">Ingresar</button>
                    </div>
                </div>
            </div>

        </div>
            
        <form id="form-login" method="post" autocomplete="off">@csrf</form>

	</body>
</html>