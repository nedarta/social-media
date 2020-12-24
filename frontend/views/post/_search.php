<?php

use yii\bootstrap4\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\PostSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-search d-flex w-100">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
                'class' => 'w-100'
        ]
    ]); ?>

    <div class="d-flex w-100">
        <input type="text" id="sentenceInput" name="sentence_count" class="form-control mb-2 flex-grow-1"
               placeholder="Number of sentences"
               value="<?= \Yii::$app->request->get('sentence_count') ?>">
        <input type="text" id="keywordInput" name="keyword" class="form-control mb-2 ml-2 flex-grow-2" placeholder="Keyword"
               value="<?= \Yii::$app->request->get('keyword') ?>">
        <div class="btn-group-toggle btn-group ml-3 h-75" data-toggle="buttons">
            <label class="btn btn-secondary active">
                <input type="radio" name="search_mode" value="or" autocomplete="off" checked>OR
            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="search_mode" value="and" autocomplete="off">AND
            </label>
        </div>
    </div>

    <div class="form-group d-flex">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary mr-2']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
        <?= Html::a('Create Post', Url::to(['/post/create']), ['class' => 'ml-auto d-block text-decoration-none']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
