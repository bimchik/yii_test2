<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersDictStatus */

$this->title = 'Update Orders Dict Status: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Orders Dict Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="orders-dict-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataTree' => $dataTree
    ]) ?>

</div>
