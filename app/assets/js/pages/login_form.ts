import '@sass/pages/login_form.scss'
import {HttpMethod, HttpUtils} from "@ts/http_utils";

type UserLoginResponseType = {
    success: boolean;
    message: string;
}

class LoginForm{
    private readonly _loginForm = document.getElementById('LoginForm') as HTMLFormElement;
    private readonly _loaderOverlay = document.getElementById('LoaderOverlay') as HTMLElement;
    private readonly _username = document.getElementById('Username') as HTMLInputElement;
    private readonly _password = document.getElementById('Password') as HTMLInputElement;

    constructor() {
        this._loginForm.addEventListener('submit', this._loginFormSubmit.bind(this));
    }

    private _loginFormSubmit = async (event: Event) => {
        event.preventDefault();

        this._loaderOverlay.classList.add('show');

        const RESPONSE: UserLoginResponseType = await HttpUtils.appFetch(HttpMethod.POST, 'api/login', {
            username: this._username.value,
            password: this._password.value,
        })

        if(!RESPONSE.success){
            alert(RESPONSE.message);
            this._loaderOverlay.classList.remove('show');
        }else{
            window.location.href = '/';
        }
    }
}

document.addEventListener('DOMContentLoaded', () => new LoginForm());