<?php
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $model \common\models\NewEmail */
/* @var $user  \common\models\User */
$confirmLink = \Yii::$app->urlManager->createAbsoluteUrl(['settings/confirm-email', 'token' => $model->token]);
$user = \Yii::$app->user->identity;
$this->title = "Update your email";

?>

Hello <?= Html::encode($user->username) ?>, you've requested a change of email(<?= $user->email ?>) to <b><?= $model->email ?>
If you didnt change your email, just ignore this message
Follow the link below to confirm your new email:
<?=  $confirmLink ?>

