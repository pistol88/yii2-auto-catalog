<?php
use yii\helpers\Html;

$this->title = 'Марки';
$this->params['breadcrumbs'][] = $this->title;

\pistol88\autocatalog\assets\BackendAsset::register($this);
?>
<div class="mark-index">
    <div class="row">
        <div class="col-md-2">
            <?= Html::a('Создать производителя', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="col-md-4">

        </div>
    </div>

    <br style="clear: both;"></div>
    
    <?= \kartik\grid\GridView::widget([
        'export' => false,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['attribute' => 'id', 'filter' => false, 'options' => ['style' => 'width: 55px;']],
            
            'name',
            [
				'attribute' => 'image',
				'format' => 'image',
                'filter' => false,
				'content' => function ($image) {
                    if($image = $image->getImage()->getUrl('50x50')) {
                        return "<img src=\"{$image}\" class=\"thumb\" />";
                    }
				}
			],
            
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}',  'buttonOptions' => ['class' => 'btn btn-default'], 'options' => ['style' => 'width: 125px;']],
        ],
    ]); ?>

</div>
