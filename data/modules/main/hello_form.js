let hello_form = new Form('hello_form');
page.bind_button(hello_form.submit_button,
    function(form_data) {
        form_data.set('method', 'say_hello');
    },
    function(response) {
        let form = hello_form;
        page.snack_bar.show_success(JSON.stringify(response));
        form.submit_button.set_status_ready();
        form.set_disabled(false);
    }
);