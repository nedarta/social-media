<?php
use yii\bootstrap4\Html;
use \yii\helpers\Url;
/** @var $model \common\models\Profile*/
/** @var $this \yii\web\View */
\frontend\assets\ProfileAsset::register($this);
$user = $model->user;
$username = Html::encode($user->username)
?>
<div class="profile-view">

    <div class="d-flex">
        <div class="profile-left text-center flex flex-column  align-items-center">
                <img class="profile-avatar text-muted border d-flex justify-content-center flex-column"
                     src="<?= $model->avatar ?>"
                     alt="<?= $model->user->username?>'s avatar"
                     style="width:250px;height:250px">
                <p class="profile-subscribers alert-success mt-3">Subscribers</p>
                <a href="<?= Url::to(['/profile/update']) ?>" class="btn btn-outline-primary w-100">Update Profile</a>
        </div>
        <div class="profile-right d-flex flex-column ml-5 w-100">
            <h6 class="profile-name"><?= $model->user->username ?></h6>
            <h3 class="border-bottom mt-3">About</h3>
            <p class="profile-status text-muted"><small>Status: </small><?= Html::encode($model->status) ?></p>
            <p class="profile-description"><small>Description: </small><?= Html::encode($model->description ?? 'There is no description') ?></p>
            <h3 class="border-bottom mt-3">Contacts</h3>
            <p><small>email:</small> <?= $user->email ?></p>
        </div>
    </div>
    <div class="profile-posts d-flex flex-column align-items-center mt-5">
        <?php foreach ($user->posts as $post) {
            echo $this->render('_post', ['model' => $post]);
        }?>
    </div>

</div>
