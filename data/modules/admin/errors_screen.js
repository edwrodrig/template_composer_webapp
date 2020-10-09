let errors_screen = new class extends Element {
    constructor() {
        super("errors_screen");
        this.table = new Table(this.id('errors_table'));

        let self = this;

        this.form = this.form('get_error_form');
        this.form.button('submit').click(function() {
            self.get_error_clicked();
        });


    }

    get_error_clicked() {
        let form = this.form;
        let error_id = form.form_data.get('error_id');

        this.show_error(error_id);
    }

    async show_error(error_id) {
        let button = this.form.button('submit');
        button.set_status_waiting();

        try {
            const response = await page.fetch(endpoint + '?method=get_error_by_error_id&error_id=' + error_id);
            const success = await response.json();

            window.open("data:application/json," + encodeURIComponent(JSON.stringify(success)),"_blank");

        } catch ( exception ) {
            page.handle_exception(exception);
        } finally {
            button.set_status_ready();
        }
    }

    async update() {
        this.update_table();
    }

    async update_table() {
        let table = this.table;
        table.clear();

        try {
            const response = await page.fetch(endpoint + '?method=get_error_list');
            const success = await response.json();

            let body = table.id('body');
            for ( let error of success ) {
                let error_id = error.i
                let user_msg = error.m;
                let dev_msg = '';
                let date = error.t ?? '';
                if ( error.hasOwnProperty('p') ) {
                    dev_msg = error.p.m;
                }
                let link = endpoint + '?method=get_error_by_error_id&error_id=' + error_id;

                let row = this.new_tpl("errors_table_item");
                row.id('error_id').textContent = error_id;
                row.id('user_msg').textContent = user_msg;
                row.id('dev_msg').textContent = dev_msg;
                row.id('date').textContent = date;
                row.id('link').href = link;

                body.appendChild(row.dom);
            }

        } catch ( exception ) {
            page.handle_exception(exception);
        } finally {
        }
    }
};

screens.selected('errors_screen', function() {
    errors_screen.update();
});

