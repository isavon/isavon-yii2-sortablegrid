<?php

namespace isavon\sortablegrid;

use yii\base\Behavior;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

/**
 * Behavior for adding sortable grid to any model.
 *
 * ```php
 *
 * // inside the model
 *
 * public function behaviors()
 * {
 *    return [
 *       [
 *           'class' => SortableGridBehavior::className(),
 *           'sortableAttribute' => 'sortOrder',
 *       ],
 *   ];
 * }
 * ```
 *
 * @author Ivan Savon <isavon.we@gmail.com>
 */
class SortableGridBehavior extends Behavior
{
    /**
     * @var string the name of sort column
     */
    public $sortableAttribute = 'sortOrder';

    public function events()
    {
        return [ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert'];
    }

    public function gridSort($items)
    {
        $model = $this->owner;
        if (!$model->hasAttribute($this->sortableAttribute)) {
            throw new InvalidConfigException('Model does not have sortable attribute `' . $this->sortableAttribute . '`.');
        }

        $newOrder = [];
        $models   = [];
        foreach ($items as $old => $new) {
            $models[$new] = $model::findOne($new);
            $newOrder[$old] = $models[$new]->{$this->sortableAttribute};
        }

        $model::getDb()->transaction(function () use ($models, $newOrder) {
            foreach ($newOrder as $modelId => $orderValue) {
                $models[$modelId]->updateAttributes([$this->sortableAttribute => $orderValue]);
            }
        });
    }

    public function beforeInsert()
    {
        $model = $this->owner;
        if (!$model->hasAttribute($this->sortableAttribute)) {
            throw new InvalidConfigException('Model does not have sortable attribute `' . $this->sortableAttribute . '`.');
        }

        $maxOrder = $model::find()->max($model::tableName() . '.' . $this->sortableAttribute);
        $model->{$this->sortableAttribute} = $maxOrder + 1;
    }
}
