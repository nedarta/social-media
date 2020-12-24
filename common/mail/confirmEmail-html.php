<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $model \common\models\NewEmail */
/* @var $user  \common\models\User */
$confirmLink = \Yii::$app->urlManager->createAbsoluteUrl(['settings/confirm-email', 'token' => $model->token]);
$user = \Yii::$app->user->identity;
$this->title = "Update your email";
?>

<div class="confirm-email">
    <p>Hello <?= Html::encode($user->username) ?>, you've requested a change of email(<b><?= $user->email ?></b>) to <b><?= $model->email ?></b></p>
    <p>If you didnt change your email, just ignore this message</p>
    <p>Follow the link below to confirm your new email:</p>
    <p><?= Html::a('Confirm new email', $confirmLink) ?></p>
</div>

