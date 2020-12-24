<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="user-search  bg-light rounded" style="">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class'=> 'p-3']
    ]); ?>
    <div class="d-flex flex-column">
        <?= $form->field($model, 'username', [
                'inputOptions' => ['placeholder' => $model->getAttributeLabel('username')],
                'template' => '{input}'
        ]) ?>
        <?= $form->field($model, 'email', [
            'inputOptions' => ['placeholder' => $model->getAttributeLabel('email'),],
            'template' => '{input}',

        ]) ?>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>