<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use pistol88\autocatalog\models\ModelOption;
use pistol88\autocatalog\models\Category;
use pistol88\autocatalog\models\Mark;
use kartik\export\ExportMenu;

$this->title = 'Модели';
$this->params['breadcrumbs'][] = $this->title;

\pistol88\autocatalog\assets\BackendAsset::register($this);
?>
<div class="model-index">

    <div class="row">
        <div class="col-md-2">
            <?= Html::a('Добавить модель', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    
    <?php
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'export' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'filter' => false, 'options' => ['style' => 'width: 55px;']],
            'name',
            'code',
            [
                'attribute' => 'images',
                'format' => 'images',
                'filter' => false,
                'content' => function ($image) {
                    if($image = $image->getImage()->getUrl('50x50')) {
                        return "<img src=\"{$image}\" class=\"thumb\" />";
                    }
                }
            ],
            [
                'attribute' => 'category_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'category_id',
                    Category::buildTextTree(),
                    ['class' => 'form-control', 'prompt' => 'Категория']
                ),
                'value' => 'category.name'
            ],
            [
                'attribute' => 'mark_id',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'mark_id',
                    ArrayHelper::map(Mark::find()->all(), 'id', 'name'),
                    ['class' => 'form-control', 'prompt' => 'Марка']
                ),
                'value' => 'mark.name'
            ],

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 125px;']],
        ],
    ]); ?>

</div>
