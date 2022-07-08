<?php

namespace isavon\sortablegrid;

use Yii;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\helpers\Json;
use yii\web\BadRequestHttpException;

/**
 * The SortableGrid action that can be used to sortable items of the grid.
 *
 * ```php
 *
 * // inside the controller
 *
 * public function actions()
 * {
 *    return [
 *       SortableGridAction::SORTABLE_ACTION => [
 *          'class' => SortableGridAction::className(),
 *          'modelName' => Model::className(),
 *       ],
 *   ];
 * }
 * ```
 *
 * @author Ivan Savon <isavon.we@gmail.com>
 */
class SortableGridAction extends Action
{
    /**
     * The action name
     */
    const SORTABLE_ACTION = 'sort';

    /**
     * @var string the model name
     */
    public $modelName;

    /**
     * Runs the action.
     *
     * @throws BadRequestHttpException
     * @throws InvalidConfigException
     */
    public function run()
    {
        if (!$items = Yii::$app->request->post('items')) {
            throw new BadRequestHttpException('Not found `items` parameter in POST.');
        }

        $model = new $this->modelName;
        if (!$model->hasMethod('gridSort')) {
            throw new InvalidConfigException(
                'Not found right `SortableGridBehavior` behavior in `' . $this->modelName . '`.'
            );
        }
        $model->gridSort(Json::decode($items));
    }
}
