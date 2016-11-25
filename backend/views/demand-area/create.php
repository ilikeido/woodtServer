<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\DemandArea */

$this->title = Yii::t('app', 'Create Demand Area');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Demand Areas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="demand-area-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
