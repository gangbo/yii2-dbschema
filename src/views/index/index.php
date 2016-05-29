<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'DB';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="channel-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn'
            ],
            'name',
            'dsn',
            'enableSchemaCache',
            'tablePrefix',
            'charset',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}',
                'urlCreator' => function ($action, $model) {
                    return \yii\helpers\Url::to([
                            "$action",
                            'dbName' => $model->name,
                        ]
                    );
                },
            ],
        ],
    ]);
    ?>

</div>
