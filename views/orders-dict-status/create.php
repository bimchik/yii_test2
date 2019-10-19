<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OrdersDictStatus */

$this->title = 'Create Orders Dict Status';
$this->params['breadcrumbs'][] = ['label' => 'Orders Dict Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-dict-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataTree'=> $dataTree
    ]) ?>

</div>
