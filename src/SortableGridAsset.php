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

    public $js = [
        'js/jquery.sortable.gridview.js',
    ];

    public $depends = [
        'backend\assets\JuiAsset',
    ];
}
