<?php
use yii\bootstrap4\Html;
use yii\helpers\StringHelper;
/* @var $model \common\models\Post */
\frontend\assets\PostAsset::register($this);

$this->title = 'Posts';
?>
        <div class="card post-card w-100" style="left: 18%">
            <a href="<?=\yii\helpers\Url::to(['/post/view', 'id' => $model->id])?>" class="text-dark text-decoration-none">
                <div class="card-header text-center"><?= StringHelper::truncate(Html::encode($model->title), 20) ?></div>
            </a>
            <div class="card-body"><?= StringHelper::truncate(Html::encode($model->body),600) ?></div>
            <div class="card-footer d-flex justify-content-between">
                <p class="post-item__author">@<?= StringHelper::truncate(Html::encode($model->author0->username), 40) ?></p>
                <p class="post-item__count"><?= $model->sentence_count ?></p>
            </div>
        </div>
