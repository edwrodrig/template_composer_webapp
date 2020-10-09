class Page extends Element {
    constructor() {
        super(document.body);
    }

    logout() {
        document.cookie = '';
        window.location.href = '/login.html';
    }

    get session_id() {
        let v = document.cookie.match('(^|;) ?session_id=([^;]*)(;|$)');
        return v ? v[2] : null;
    }

    get snack_bar() {
        return new SnackBar('snack_bar');
    }

    handle_error(data) {
        let code = data.i;
        let message = data.m;
        let str = message + " [" + code + "]";
        this.snack_bar.show_error(str);
    }

    async handle_exception(exception) {
        if ( exception instanceof Response ) {
            const error = await exception.json();
            this.handle_error(error);
        } else {
            this.snack_bar.show_error('A ocurrido un problema. Por favor actualize la página');
            console.log(exception);
        }
    }

    get url_params() {
        let url = new URL(window.location);
        return new URLSearchParams(url.search);
    }

    async fetch(endpoint, params) {
        let response
        if ( params === undefined ) {
            response = await fetch(endpoint);
        }
        else if ( params instanceof FormData ) {
            response = await fetch(endpoint, {
                method: 'POST',
                body: params
            });
        }  else {
            response = await fetch(endpoint, {
                method: 'POST',
                headers:  {'Content-Type' : 'application-json'},
                body: JSON.stringify(params)
            });
        }

        if ( !response.ok ) {
            throw response;
        }

        return response;

    }
}