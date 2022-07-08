<h1 align="center">
    yii2-sortablegrid
    <hr />
</h1>

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

To install, either run

```
$ php composer.phar require isavon/yii2-sortablegrid "@dev"
```

or add

```
"isavon/yii2-sortablegrid": "@dev"
```

to the ```require``` section of your `composer.json` file.

## Changes

> NOTE: Refer the [CHANGE LOG](https://github.com/isavon/yii2-sortablegrid/blob/master/CHANGE.md) for details on changes to various releases.

## Usage

Add SortableGridAction to your controller.

```php
public function actions()
{
    return [
        SortableGridAction::SORTABLE_ACTION => [
            'class' => SortableGridAction::className(),
            'modelName' => Model::className(),
        ],
    ];
}
```

Add SortableGridBehavior to your model.

```php
public function behaviors()
{
    return [
        [
            'class' => SortableGridBehavior::className(),
            'sortableAttribute' => 'sortOrder',
        ],
    ];
}
```

And add SortableGridView to your view file.

```php
<?= SortableGridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name',
        'created_at',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
        ],
    ],
]) ?>
```

Done!