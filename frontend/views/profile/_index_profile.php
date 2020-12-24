<?php
use yii\bootstrap4\Html;
use yii\helpers\Url;
/* @var $model \common\models\User */
$profile = $model->profile;
\frontend\assets\ProfileAsset::register($this);
?>

<div class="user-item border rounded d-flex mb-3">
    <img src="<?= $profile->avatar ?>" class="profile-avatar p-3 rounded" width="200px" height="200px">
    <div class="user-info p-3">
        <a href="<?= Url::to(['/user/' . $model->username])?>"
            class="text-decoration-none text-dark">
            <h5><?= Html::encode($model->username) ?></h5>
        </a>
        <div class="text-muted">

            <p class="mb-0"><small>Email:</small> <?= $model->email ?></p>
            <p><small>Created:</small> <?= Yii::$app->formatter->asDate($model->created_at, 'd-M-Y') ?></p>
        </div>
    </div>
</div>
