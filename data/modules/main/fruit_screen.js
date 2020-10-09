let fruit_screen = new class extends Element {
    constructor() {
        super("fruit_screen");

        this.table = new Table(this.id('fruit_table'));

    }

    async update() {
        let table = this.table;
        try {
            const response = await page.fetch(endpoint + '?method=get_fruit_list');
            const success = await response.json();

            table.clear();
            for (let fruit of success) {
                let name = fruit.name;
                let color = fruit.color;
                let link = fruit.link;

                let row = this.new_tpl('fruit_table_item');
                row.id('name').textContent = name;
                row.id('color').textContent = color;
                row.id('link').href = link;

                table.id('body').appendChild(row.dom);
            }

        } catch ( exception ) {
            page.handle_exception(exception);
        }
    }

};

screens.selected('fruit_screen', function() {
    fruit_screen.update();
});

