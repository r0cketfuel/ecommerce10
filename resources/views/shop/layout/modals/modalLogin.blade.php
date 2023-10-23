
<div class="modal" id="modal-login">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">

    <div class="login-panel">
        <div class="left-panel">
            <h1>Login</h1>
            <p>{{ __('general.register_msg') }} <a class="register-link" href="/shop/register"><span>{{ __('general.register_link') }}</span></a></p>
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
            <div class="input-group">
                <button form="form-login" type="submit" class="btn-primary">{{ __('general.login_button') }}</button>
                <button form="form-guest" type="submit" class="btn-secondary">{{ __('general.login_guest_button') }}</button>
            </div>
        </div>
        <div class="right-panel">
            <div style="text-align:right; cursor: pointer" onclick="this.parentElement.parentElement.parentElement.parentElement.style.display='none'">X</div>
            <div>
                <h2>{{ session("infoComercio.nombre") }}</h2>
                <h4>{{ session("infoComercio.slogan") }}</h4>
            </div>
            <div></div>
        </div>
    </div>

    </div>
</div>

<form id="form-login" method="post" autocomplete="off" action="{{ route('login.user') }}">@csrf</form>
<form id="form-guest" method="post" autocomplete="off" action="{{ route('login.guest') }}">@csrf</form>
