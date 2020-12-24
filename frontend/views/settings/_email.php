<?php
use yii\bootstrap4\Html;
use yii\helpers\Url;
/* @var $this \yii\web\View */
/* @var $model \frontend\models\UpdateEmailForm */
$this->title = 'Settings';
?>


<?php \yii\widgets\Pjax::begin(['id' => 'email-pjax']) ?>
<?= \common\widgets\Alert::widget() ?>

<?php $form = \yii\bootstrap4\ActiveForm::begin(['options' => [
        'data-pjax' => 'true',
        'style' => 'min-width: 250px;max-width: 350px;']]); ?>
    <?php $form->action = Url::to(['/settings/update-email']) ?>
    <?= $form->field($model, 'old_email')->textInput()->label('Old Email') ?>
    <?= $form->field($model, 'new_email')->textInput()->label('New Email') ?>
    <div class="form-group">
        <?= Html::submitButton('Update Email', ['class' => 'btn btn-success']) ?>
    </div>
<?php \yii\bootstrap4\ActiveForm::end(); ?>
<?php \yii\widgets\Pjax::end() ?>

