let fruit_table = new Table('fruit_table');
    fruit_table.update_button.add_click_listener(fruit_table_update);

function fruit_table_update() {
    let table = fruit_table;
    table.set_status_waiting();
    fetch(endpoint + '?method=get_fruit_list')
        .then(page.handle(
            function (json) {
                table.clear();
                for (let fruit of json) {
                    let name = fruit.name;
                    let color = fruit.color;
                    let link = fruit.link;

                    let row = new Element(table.row_element);
                    row.get_element_by_role('name').textContent = name;
                    row.get_element_by_role('color').textContent = color;
                    row.get_element_by_role('link').href = link;

                    table.body.appendChild(row.element);

                }
                table.update_button.set_status_ready();
            },
            function (json) {
                page.handle_error(json);
                table.clear();
                table.update_button.set_status_ready();

            }));
}

fruit_table_update();

