/**
 * Helpers Class
 * @description Helpers functions used to serve all app
 * @author Ahmed Sharaf (sharaf.developer@gmail.com)
 * @copyright (c) 2015 Digitree (http://digitreeinc.com), All Right Reserved.
 * @version 1.0.0
 */

/**
 * Global Namespace
 * @type {Object}
 */
var Helpers = Helpers || {};

/**
 * Runs when document is ready
 */
Helpers.onReady = function () {
    console.log('Helpers working..');
};

$(document).ready(function () {
    Helpers.onReady();
});
