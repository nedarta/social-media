<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \common\models\Post */
/* @var $pages \yii\data\Pagination */
\frontend\assets\PostAsset::register($this);
$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <div class="d-flex justify-content-md-between flex-wrap w-100">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <?= \yii\widgets\ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_post',
            'layout' => '<div class="post-items d-flex flex-column w-75">{items}</div>{pager}',
            'itemOptions' => [
                'tag' => false
            ],
            'pager' => [
                'class' => \yii\bootstrap4\LinkPager::class,
                'pagination' => $pages,
                'options' => [
                        'class' => 'd-flex'
                ],
                'listOptions' => [
                        'class' => 'pagination m-auto'
                ]
            ],
        ]
    ) ?>
</div>
