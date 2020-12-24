<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => 20]) ?>
    <?= $form->field($model, 'body')->textarea(['rows' => 10]) ?>

    <div class="d-flex justify-content-between">
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>
        <div class="mr-5">
            <p>Number of sentences: <span id="sentence_count">0</span></p>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
