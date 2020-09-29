class Page {
    get_session_id() {
        let session_id = localStorage.getItem('session_id');
        if ( session_id === null ) {
            window.location.href = '/login.html';
        } else {
            return session_id;
        }
    }

    logout() {
        localStorage.removeItem('session_id');
        window.location.href = '/login.html';
    }

    handle(success, failure) {
        return function(response) {
            if (response.ok) {
                response.json()
                    .then(success);
            } else {
                response.json()
                    .then(failure);
            }
        }
    }

    get snack_bar() {
        return new SnackBar('snack_bar');
    }

    handle_error(data) {
        let code = data.i;
        let message = data.m;
        let str = "[codigo: " + code + "] " + message;
        this.snack_bar.show_error(str);
    }

    bind_button(target_button, form_set_callback, success_callback) {
        target_button.add_click_listener(function() {
            let form = target_button.form;
            let form_data = form.form_data;
            form_set_callback(form_data);

            form.set_disabled(true);
            target_button.set_status_waiting();

            fetch(endpoint, {
                method: 'POST',
                body: form_data
            }).then(page.handle(success_callback,
                function(json) {
                    page.handle_error(json);
                    target_button.set_status_ready();
                    form.set_disabled(false);
                }
            ));
        })
    }
}
