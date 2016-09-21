$('table tbody').sortable({
    handle: '.sw-handler',
    placeholder: 'sw-placeholder',
    cursor: 'move',
    helper: function (e, ui) {
        ui.children().each(function () {
            $(this).width($(this).width());
        });
        return ui;
    },
    start: function (event, ui) {
        ui.item.data('prev-index', ui.item.index());
    },
    update: function (event, ui) {
        var replacment,
            prev_index = ui.item.data('prev-index'),
            new_index = ui.item.index();
        /*which item place take dragged item*/
        if (prev_index < new_index) {
            replacment = ui.item.prev().data('key');
        } else {
            replacment = ui.item.next().data('key');
        }
        var data = {
            //prev_index: prev_index,
            //new_index: new_index,
            dragged: ui.item.data('key'),
            replacment: replacment,
            sortModel: ui.item.parents('table').data('sort-model'),
            sortAttr: ui.item.parents('table').data('sort-attr'),
        };

        var url = ui.item.parents('table').data('sort-url');

        $.post(url, data);
    }
});
