<?php

use yii\helpers\Html;

$this->title = 'Создать марку';
$this->params['breadcrumbs'][] = ['label' => 'Марки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mark-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
