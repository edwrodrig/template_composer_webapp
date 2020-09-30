let error_table = new Table('error_table');
error_table.update_button.add_click_listener(error_table_update);
let get_error_form = new Form('get_error_form');

page.bind_button(get_error_form.submit_button,
    function(form_data) {
        form_data.set('method', 'get_error_by_error_id');
    },
    function(response) {
        let form = get_error_form;
        form.submit_button.set_status_ready();
        form.set_disabled(false);
        window.open("data:application/json," + encodeURIComponent(JSON.stringify(response)),"_blank");
});

function error_table_update() {
    let table = error_table;
    table.set_status_waiting();
    fetch(endpoint + '?method=get_error_list')
        .then(page.handle(
            function(response) {
                table.clear();
                for ( let error of response ) {
                    let error_id = error.i
                    let user_msg = error.m;
                    let dev_msg = '';
                    if ( error.hasOwnProperty('p') )
                        dev_msg = error.p.m;
                    let link = endpoint + '?method=get_error_by_error_id&error_id=' + error_id;

                    let row = new Element(table.row_element);
                    row.get_element_by_role('error_id').textContent = error_id;
                    row.get_element_by_role('user_msg').textContent = user_msg;
                    row.get_element_by_role('dev_msg').textContent = dev_msg;
                    row.get_element_by_role('link').href = link;

                    table.body.appendChild(row.element);
                }

                table.update_button.set_status_ready();
            },
            function(json) {
                page.handle_error(json);
                table.clear();
                table.update_button.set_status_ready();
            }
        ))
}

error_table_update();