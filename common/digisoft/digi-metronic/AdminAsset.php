<?php

/**
 * Metronic Admin Asset
 * @author Ahmed Sharaf <sharaf.developer@gmail.com>
 * @copyright Copyright (c) 2015 Digitree
 */

namespace digi\metronic;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle {

    //public $sourcePath = '@metronicPath/assets/';
    public $basePath = '@metronicPath/assets/';
    public $baseUrl = '@metronicUrl/assets/';
    
    public $css = [
        /** BEGIN GLOBAL MANDATORY STYLES **/
        'global/plugins/font-awesome/css/font-awesome.min.css',
        'global/plugins/simple-line-icons/simple-line-icons.min.css',
        'global/plugins/bootstrap-switch/css/bootstrap-switch.min.css',
        'global/plugins/uniform/css/uniform.default.css',
        /** END GLOBAL MANDATORY STYLES **/
        /** BEGIN PAGE LEVEL PLUGIN STYLES **/
        'global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css',
        'admin/pages/css/login-soft.css',
        'admin/pages/css/error.css',
        /** END PAGE LEVEL PLUGIN STYLES **/
        /** BEGIN PAGE STYLES **/
        /** END PAGE STYLES **/
        /** BEGIN THEME STYLES **/
        'global/css/components.css',
        'global/css/plugins.css',
        'admin/layout/css/layout.css',
        'admin/layout/css/themes/dgtree.css',
        'admin/layout/css/custom.css',
        /** END THEME STYLES **/
    ];

    /**
     * <!--[if lt IE 9]>
     *   <script src="assets/global/plugins/respond.min.js"></script>
     *   <script src="assets/global/plugins/excanvas.min.js"></script> 
     * <![endif]-->
     */
    public $js = [
        /** BEGIN CORE PLUGINS * */
        'global/plugins/jquery-migrate-1.2.1.min.js',
        'global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js',
        'global/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
        'global/plugins/jquery.blockui.min.js',
        'global/plugins/jquery.cokie.min.js',
        'global/plugins/uniform/jquery.uniform.min.js',
        'global/plugins/bootstrap-switch/js/bootstrap-switch.min.js',
        /** END CORE PLUGINS * */
        /** BEGIN PAGE LEVEL PLUGINS * */
        /** END PAGE LEVEL PLUGINS * */
        /** BEGIN PAGE LEVEL SCRIPTS * */
        'global/scripts/metronic.js',
        'admin/layout/scripts/layout.js',
        'admin/layout/scripts/quick-sidebar.js',
        'admin/layout/scripts/demo.js',
        /** END PAGE LEVEL SCRIPTS * */
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //IMPORTANT! Load jquery-ui.js before bootstrap.js to fix bootstrap tooltip conflict with jquery ui tooltip
        'yii\jui\JuiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];


}
