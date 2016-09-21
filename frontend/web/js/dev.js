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
    Dev.mainInit();
    Dev.globalEvents();
};

/**
 * Manages global application events.
 * @author Ahmed Sharaf (sharaf.developer@gmail.com)
 */
Dev.globalEvents = function () {
    var self = this;
    
    self.manageHeaderSearchForm = function () {
        $('#headerSearchForm i').click(function () {
            $('#headerSearchForm').submit();
        });
        $('#headerSearchForm').submit(function () {
            if (!$.trim($('#headerSearchForm input').val()))
                return false;
        });
    };
    
    self.autoSubmitProductForm = function () {
        $('body').on('change', '#productForm select', function () {
            $('#productForm').submit();
        });
    };

    self.autoSubmitSearchForm = function () {
        $('body').on('change', '#searchForm select', function () {
            $('#searchForm').submit();
        });
        $('body').on('click', '#alphabetChar li', function () {
            $('#searchform-alpha').val($(this).data('id'));
            $('#searchForm').submit();
        });
        //$('#alphabetChar li[data-id="' + $('#searchform-alpha').val() + '"]').addClass('current');
    };

    self.autoTriggerLoginBtn = function () {
        if (window.location.hash == '#login') {
            $('.login-btn').trigger('mouseenter');
        }
    };
    
    self.triggerFacbookLoginBtn = function () {
        $('.facebook-login, .facebook-signup').click(function(){
            $('#facebookLogin a').trigger('click');
        });
    };
    
    self.manageHeaderSearchForm();
    self.autoSubmitProductForm();
    self.autoSubmitSearchForm();
    self.autoTriggerLoginBtn();
    self.triggerFacbookLoginBtn();

}

/**
 * Re Initialize some components after ajax event.
 * @author Ahmed Sharaf (sharaf.developer@gmail.com)
 */
Dev.reInit = function () {
    TSS.initializeFoundation();
};

/**
 * Initialize main components required to run the application
 * @author Ahmed Sharaf (sharaf.developer@gmail.com)
 */
Dev.mainInit = function () {
};


$(document).ready(function () {
    Dev.onReady();
});

//ajaxSuccess event callback  
$(document).ajaxSuccess(function (event, xhr, options) {
    Dev.reInit();
});