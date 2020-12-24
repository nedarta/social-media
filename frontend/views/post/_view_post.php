<?php
use yii\bootstrap4\Html;
use yii\helpers\Url;
/** @var $model \common\models\Post */

?>


<div class="post-view">
    <div class="post-header d-flex justify-content-between">
        <div>
            <h6 class="post-title"><?= Html::encode($model->title) ?></h6>
        </div>
        <div class="d-flex justify-content-between ml-auto">
            <p class="post-created text-muted mr-3">
                <?= \Yii::$app->formatter->asDateTime($model->created_at) ?>
            </p>
            <p class="post-author"><?= Html::a('@' . $model->getAuthorName(), Url::to(['/user/view', 'id' => $model->author]), ['class' => 'text-decoration-none text-dark',]) ?></p>
        </div>
    </div>

    <div class="post-body">
        <p ><?=Html::encode($model->body) ?></p>
    </div>
    <div class="post-footer mb-3 text-muted">
        <p>
            <?= $model->getAttributeLabel('sentence_count') ?>:
            <?= $model->sentence_count ?>
        </p>
    </div>
</div>

