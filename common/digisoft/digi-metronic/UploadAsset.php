<?php

/**
 * Metronic Upload Asset
 * @author Ahmed Sharaf <sharaf.developer@gmail.com>
 * @copyright Copyright (c) 2015 Digitree
 */

namespace digi\metronic;

use yii\web\AssetBundle;

class UploadAsset extends AssetBundle {

    public $sourcePath = '@metronicPath/assets/';
    public $css = [
        /** BEGIN PAGE LEVEL PLUGIN STYLES **/
        'global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css',
        'global/plugins/jquery-file-upload/css/jquery.fileupload.css',
        'global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css',
        /** END PAGE STYLES **/
    ];

    public $js = [
        /** BEGIN PAGE LEVEL PLUGINS * */
        'global/plugins/fancybox/source/jquery.fancybox.pack.js',
        /** END PAGE LEVEL PLUGINS * */
        /** BEGIN:File Upload Plugin JS files * */
        'global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js',
        'global/plugins/jquery-file-upload/js/vendor/tmpl.min.js',
        'global/plugins/jquery-file-upload/js/vendor/load-image.min.js',
        'global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js',
        'global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js',
        'global/plugins/jquery-file-upload/js/jquery.iframe-transport.js',
        'global/plugins/jquery-file-upload/js/jquery.fileupload.js',
        'global/plugins/jquery-file-upload/js/jquery.fileupload-process.js',
        'global/plugins/jquery-file-upload/js/jquery.fileupload-image.js',
        'global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js',
        'global/plugins/jquery-file-upload/js/jquery.fileupload-video.js',
        'global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js',
        'global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js',
        /** END:File Upload Plugin JS files * */
        'admin/pages/scripts/form-fileupload.js',
    ];

}
