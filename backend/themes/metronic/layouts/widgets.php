<?php
//Colorbox widget
echo himiklab\colorbox\Colorbox::widget([
    'targets' => [
        '.colorboxIframe' => [
            'iframe' => true,
            'width' => '80%',
            'height' => '80%',
        ],
        '.colorboxImg' => [
            'rel' => 'colorboxGroup',
            'width' => '80%',
            'height' => '80%',
        ],
    ],
    'coreStyle' => 2
]);
?>
