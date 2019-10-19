<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\OrdersDictStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders Dict Statuses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-dict-status-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Orders Dict Status', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    yii\bootstrap\Modal::begin([
        'headerOptions' => ['id' => 'modalHeader'],
        'id' => 'modal',
        'size' => 'modal-lg',
        'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
    ]);
    echo "<div id='modalContent'></div>";
    yii\bootstrap\Modal::end();
    ?>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-striped table-bordered'
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],


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


            [
                'attribute'=>'alias',
                'label'=>'Алиас',

            ],

            [
                'class'=>'kartik\grid\ExpandRowColumn',
                //'width'=>'50px',
                'value'=>function ($model, $key, $index, $column) {
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
                //'disabled'=>true,
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update}  {delete}',
            ]
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
