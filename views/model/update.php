<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = Html::encode($model->name);
$this->params['breadcrumbs'][] = ['label' => 'Модели', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="model-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?php if($fieldPanel = \pistol88\field\widgets\Choice::widget(['model' => $model])) { ?>
        <div class="block">
            <h2>Прочее</h2>
            <?=$fieldPanel;?>
        </div>
    <?php } ?>
</div>
