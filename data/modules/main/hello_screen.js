let hello_screen = new class extends Element {
    constructor() {
        super("hello_screen");

        this.form = this.form('hello_form');

        let self = this;
        this.form.button('submit').click(function() {
           self.say_hello_clicked();
        });
    }

    async say_hello_clicked() {
        let form = this.form;
        let button = form.button('submit');
        let form_data = form.form_data;

        form_data.set('method', 'say_hello');

        form.set_disabled(true);
        button.set_disabled(true);

        try {
            const response = await page.fetch(endpoint, form_data);
            const success = await response.json();

            page.snack_bar.show_success(JSON.stringify(success));


        } catch ( exception ) {
            page.handle_exception(exception);
        } finally {
            button.set_status_ready();
            form.set_disabled(false);
        }
    }

};
