<?php
/* @var $this \yii\web\View */
/* @var $model \frontend\models\UpdatePasswordForm */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Pjax;
?>

<?php Pjax::begin(['id' => 'password-pjax']) ?>

<?= \common\widgets\Alert::widget() ?>

<?php $form = ActiveForm::begin(['options' => [
        'data-pjax' => 'true',
        'style' => 'min-width:250px;max-width:350px'
]]) ?>
    <?php $form->action = '/settings/update-password'; ?>
    <?= $form->field($model, 'old_password')->passwordInput(); ?>
    <?= $form->field($model, 'new_password')->passwordInput()->label('Password'); ?>
    <?= $form->field($model, 'new_password_repeat')->passwordInput()->label('Password Confirmation'); ?>
    <div class="form-group">
        <?= Html::submitButton('Update password', ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end(); ?>
<?php Pjax::end() ?>
