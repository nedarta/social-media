<?php
use yii\helpers\StringHelper;
use yii\bootstrap4\Html;
/** @var \common\models\Post $model  */
?>

<div class="post-card w-100 mb-5">
        <div class="card">
            <div class="card-header d-flex justify-content-between p-2 align-items-center">
                <a href="<?=\yii\helpers\Url::to(['/post/view', 'id' => $model->id])?>" class="text-dark text-decoration-none">
                    <p class="ml-3 mb-0"><?= StringHelper::truncate(Html::encode($model->title), 20) ?></p>
                </a>
                <p class="post-item__count m-0"><?= $model->sentence_count ?></p>
            </div>
            <div class="card-body"><?= Html::encode($model->body) ?></div>
        </div>
</div>
