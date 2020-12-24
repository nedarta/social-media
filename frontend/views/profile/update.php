<?php
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model    \common\models\ProfileForm*/
\frontend\assets\ProfileAsset::register($this);
$this->title = 'Update Profile';
?>
<div class="profile-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="profile-avatar text-center">
        <img class="profile-avatar text-muted border d-flex justify-content-center flex-column"
             src="<?= $model->user->profile->avatar ?>"
             alt="Your profile photo"
             style="width:250px;height:250px">
    </div>
    <?=  Html::a('Delete Avatar', Url::to(['/profile/avatar-delete']),
        ['class' => 'btn btn-danger mt-2', 'data-method' => 'post', 'style' => 'width: 250px']) ?>
    <?= $form->field($model, 'avatar', [
        'options' => ['class'=>'mt-2 mb-3 custom-file'],
        'inputOptions' => ['class' => 'custom-file-input'],
        'labelOptions' => ['class' => 'custom-file-label', 'value' => '', 'style' => 'width:250px']
    ])->fileInput(['max' => '2']) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 20]) ?>
    <?= $form->field($model, 'status')->textInput(['max' => 255]) ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6, 'max' => 255, 'placeholder' =>  'Add your description here']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-outline-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

