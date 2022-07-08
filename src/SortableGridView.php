<?php

namespace isavon\sortablegrid;

use yii\helpers\Url;
use yii\grid\GridView;

/**
 * SortableGridView
 *
 * @author Ivan Savon <isavon.we@gmail.com>
 */
class SortableGridView extends GridView
{
    /**
     * Runs the widget.
     */
    public function run()
    {
        $view = $this->getView();
        $link = Url::to([SortableGridAction::SORTABLE_ACTION]);
        $view->registerJs("jQuery('#{$this->options['id']}').SortableGridView('$link')");
        SortableGridAsset::register($view);
        parent::run();
    }
}
