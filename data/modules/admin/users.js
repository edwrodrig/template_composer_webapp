let create_user_form = new Form('create_user_form');
let set_user_type_form = new Form('set_user_type_form');
let set_user_password_form = new Form('set_user_password_form');

page.bind_button(create_user_form.submit_button,
    function(form_data)
    {
        form_data.set('method', 'create_user');
    },
    function(json) {
        let form = create_user_form;
        page.snack_bar.show_success('Usuario creado!');
        form.set_disabled(false);
        form.submit_button.set_status_ready();
    }
);

page.bind_button(set_user_type_form.submit_button,
    function(form_data) {
        form_data.set('method', 'set_user_type');
    },
    function(json) {
        let form = set_user_type_form;
        page.snack_bar.show_success('Cambio de tipo de usuario exitoso!');
        form.set_disabled(false);
        form.submit_button.set_status_ready();
    }
);

page.bind_button(set_user_password_form.submit_button,
    function(form_data) {
        form_data.set('method', 'set_user_password');
    },
    function(json) {
        let form = set_user_password_form;
        page.snack_bar.show_success('Cambio de contraseña de usuario exitosa!');
        form.set_disabled(false);
        form.submit_button.set_status_ready();
    }
);