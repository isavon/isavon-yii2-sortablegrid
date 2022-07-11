<?php

namespace isavon\sortablegrid;

use yii\web\AssetBundle;

/**
 * Base asset bundle.
 *
 * @author Ivan Savon <isavon.we@gmail.com>
 */
class SortableGridAsset extends AssetBundle
{
    public $sourcePath = '@isavon/sortablegrid/assets';

    public $css = [
        'vendor/jquery-ui/css/jquery-ui.css',
    ];

    public $js = [
        'vendor/jquery-ui/js/jquery-ui.min.js',
        'js/jquery.sortable.gridview.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
    ];
}
