<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersDictStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<div class="orders-dict-status-index">

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'tableOptions' => [
            'class' => 'table table-striped table-bordered'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],


            [
                'attribute'=>'name',
                'label'=>'Имя',

            ],
            [
                'format' => 'html',
                'label' => 'Цвет',
                'contentOptions' => function ($model, $key, $index, $column) {
                    return ['style'=>'text-align: center;'];
                },

                'content'=>function($data){
                    return '<div style="margin: 20px auto; background-color:'.$data->color.'; color:'.$data->text_color.'; width: 20px; height: 20px; display: block"><br>Текст</div>';
                }
            ],

            /*[
                'attribute'=>'parent_id',
                'label'=>'Родительская категория',
                'value' => function($model, $index, $dataColumn) {

                    return $model->parent['name'];

                },
            ],*/
            [
                'attribute'=>'alias',
                'label'=>'Алиас',

            ],

            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function ($model, $key, $index, $column) {
                    return GridView::ROW_COLLAPSED;
                },
                'detail'=>function ($model, $key, $index, $column) {
                    $searchModel = new \app\models\OrdersDictStatusSearch();
                    $searchModel->parent_id = $model->id;
                    $dataProvider = $searchModel->getChildrens(Yii::$app->request->queryParams,$searchModel->parent_id);


                    return Yii::$app->controller->renderPartial('_status_items', [
                        'searchModel'=>$searchModel,
                        'dataProvider'=>$dataProvider,

                    ]);
                },
                'headerOptions'=>['class'=>'kartik-sheet-style']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update}  {delete}',
            ]
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
