<?php

use gangbo\dbschema\AssetBundle;
use yii\bootstrap\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

AssetBundle::register($this);

/* @var $this yii\web\View */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Api Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="api-user-view">

    <?php $form = ActiveForm::begin([
        'method' => 'get'
    ]); ?>
    <?= $form->field($model, 'name', [
        'inputOptions' => [
            'name' => 'dbName',
        ],
        'labelOptions' => [
            'label' => '请输入你配置的DB组件名',
        ],
    ]) ?>
    <?= Html::submitButton('查询', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'dsn',
            'username',
            'schemaCache',
            'charset',
            'tablePrefix',
        ],
    ]) ?>

    <?php Pjax::begin(); ?>
    <!-- alert begin -->
    <?php foreach (Yii::$app->session->getAllFlashes() as $type => $message): ?>
        <?php if (in_array($type, ['success', 'danger', 'warning', 'info'])): ?>
            <div class="alert alert-<?= $type ?>">
                <?= $message ?>
            </div>
        <?php endif ?>
    <?php endforeach ?>
    <!-- alert end -->

    <?= \yii\grid\GridView::widget([
        'dataProvider' => $tbSchemaProvider,
        'columns' => [
            [
                'label' => 'table name',
                'attribute' => 'fullName',
            ],
            [
                'label' => 'fields',
                'content' => function ($tbSchema) {
                    /** @var \yii\db\TableSchema $tbSchema */
                    $str = '';
                    foreach ($tbSchema->columns as $column) {
                        $str .= $column->name . ' : ' . $column->type . '<br/>';
                    }
                    return $str;
                },
            ],
            [
                'label' => '刷新',
                'content' => function ($tbSchema) use ($model) {
                    /** @var \yii\db\TableSchema $tbSchema */
                    return Html::a(
                        '刷新',
                        [
                            'refresh',
                            'dbName' => $model->name,
                            'tbName' => $tbSchema->name,
                            'tbN' => $tbSchema->fullName
                        ],
                        [
                            'class' => 'btn btn-success',
                            'data' => [
                                //'confirm' => "确定要刷新db schema cache?",
                                'method' => 'post',
                                'pjax' => '1',
                                'params' => [
                                ]
                            ]
                        ]
                    );
                },
            ]
        ]
    ]) ?>
    <?php Pjax::end(); ?>

</div>
