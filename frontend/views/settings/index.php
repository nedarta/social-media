<?php
use frontend\models\UpdateEmailForm;
use frontend\models\UpdatePasswordForm;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model \common\models\User */
?>

<div class="user-settings">
    <h2>Password</h2>
    <hr />
    <?= $this->render('_password', ['model' => new UpdatePasswordForm()]) ?>
    <h2>Email</h2>
    <hr />
    <?= $this->render('_email', ['model' => UpdateEmailForm::fromUser(\Yii::$app->user->identity)]) ?>
    <hr />
    <div>
        <a href="<?= Url::to(['/profile/delete']) ?>" data-method="post" data-confirm="Are you sure?" class="btn btn-danger">Delete Account</a>
    </div>
</div>
