/**
 * UI Class
 * @description Functions written by developers
 * @author Ahmed Sharaf (sharaf.developer@gmail.com)
 * @copyright (c) 2015 Digitree (http://digitreeinc.com), All Right Reserved.
 * @version 1.0.0
 */

/**
 * Global Namespace
 * @type {Object}
 */
var UI = UI || {};

/**
 * Runs when document is ready
 * @author Ahmed Sharaf (sharaf.developer@gmail.com)
 */
UI.onReady = function () {
    UI.mainInit();
};

/**
 * Re Initialize some components after ajax event.
 * @author Ahmed Sharaf (sharaf.developer@gmail.com)
 * @todo Find more smart solution
 */
UI.reInit = function () {};

/**
 * Initialize main components required to run the application
 * @author Ahmed Sharaf (sharaf.developer@gmail.com)
 */
UI.mainInit = function () {};


$(document).ready(function () {
    UI.onReady();
});
