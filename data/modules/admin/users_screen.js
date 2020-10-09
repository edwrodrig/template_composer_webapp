let users_screens = new class extends Element {
    constructor() {
        super("users_screen");
        this.create_user_form = this.form('create_user_form');
        this.set_user_type_form = this.form('set_user_type_form');
        this.set_user_password_form = this.form('set_user_password_form');

        let self = this;
        this.create_user_form.button('submit').click(function() {
            self.create_user_clicked();
        });

        this.set_user_type_form.button('submit').click(function() {
            self.set_user_type_clicked();
        });

        this.set_user_password_form.button('submit').click(function() {
            self.set_user_password_clicked();
        });
    }

    async create_user_clicked() {
        let form = this.create_user_form;
        let button = form.button('submit');

        let form_data = form.form_data;
        form_data.set('method', 'create_user');

        form.set_disabled(true);
        button.set_status_waiting();

        try {
            const response = await page.fetch(endpoint, form_data);

            page.snack_bar.show_success('Usuario creado!');

        } catch ( exception ) {
            page.handle_exception(exception);
        } finally {
            form.set_disabled(false);
            button.set_status_ready();
        }
    }

    async set_user_type_clicked() {
        let form = this.set_user_type_form;
        let button = form.button('submit');

        let form_data = form.form_data;
        form_data.set('method', 'set_user_type');

        form.set_disabled(true);
        button.set_status_waiting();

        try {
            const response = await page.fetch(endpoint, form_data);

            page.snack_bar.show_success('Cambio de tipo de usuario exitoso!');

        } catch ( exception ) {
            page.handle_exception(exception);
        } finally {
            form.set_disabled(false);
            button.set_status_ready();
        }
    }

    async set_user_password_clicked() {
        let form = this.set_user_password_form;
        let button = form.button('submit');

        let form_data = form.form_data;
        form_data.set('method', 'set_user_password');

        form.set_disabled(true);
        button.set_status_waiting();

        try {
            const response = await page.fetch(endpoint, form_data);

            page.snack_bar.show_success('Cambio de contraseña de usuario exitosa!');

        } catch ( exception ) {
            page.handle_exception(exception);
        } finally {
            form.set_disabled(false);
            button.set_status_ready();
        }
    }
};

