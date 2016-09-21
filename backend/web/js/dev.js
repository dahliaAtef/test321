/**
 * Dev Class
 * @description Functions written by developers
 * @author Ahmed Sharaf (sharaf.developer@gmail.com)
 * @copyright (c) 2015 Digitree (http://digitreeinc.com), All Right Reserved.
 * @version 1.0.0
 */

/**
 * Global Namespace
 * @type {Object}
 */
var Dev = Dev || {};

/**
 * Runs when document is ready
 * @author Ahmed Sharaf (sharaf.developer@gmail.com)
 */
Dev.onReady = function () {
    console.log('Dev working..');
    Dev.mainInit();
    //pjax:success event callback  
//    $(document).on('pjax:success', function (event, data, status, xhr, options) {
//        Dev.reInit();
//    });
    Dev.manageProductForm();
};

/**
 * Re Initialize some components after ajax event.
 * @author Ahmed Sharaf (sharaf.developer@gmail.com)
 * @todo Find more smart solution
 */
Dev.reInit = function () {
    /**
     * reinit colorbox items
     */
    $('.colorboxIframe').colorbox({"iframe": true, "width": "80%", "height": "80%"});
    $('.colorboxImg').colorbox({"rel": "colorboxGroup", "width": "80%", "height": "80%"});

    /**
     * reinit sortable
     */
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

};

/**
 * Initialize main components required to run the application
 * @author Ahmed Sharaf (sharaf.developer@gmail.com)
 */
Dev.mainInit = function () {
    Metronic.init(); // init metronic core componets
    Layout.init(); // init layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features
};


/**
 * Manage product Form
 */
Dev.manageProductForm = function () {
    if ($('#product-parent_id').val()) {
        $('.childFields').show();
        $('.parentFields').hide();
    } else {
        $('.childFields').hide();
        $('.parentFields').show();
    }
    $('#product-parent_id').change(function () {
        if ($(this).val()) {
            $('.childFields').show();
            $('.parentFields').hide();
        } else {
            $('.childFields').hide();
            $('.parentFields').show();
        }
    });
};

$(document).ready(function () {
    Dev.onReady();
});

//ajaxSuccess event callback  
$(document).ajaxSuccess(function (event, xhr, options) {
    Dev.reInit();
});