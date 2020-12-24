<?php
/* @var $this yii\web\View */
/* @var $searchModel \common\models\UserSearch */
/* @var $dataProvider \yii\debug\models\timeline\DataProvider */
/* @var $pages \yii\data\Pagination */
$this->title = 'Users';
?>
<div class="profile-index d-flex justify-content-between w-100">

    <div class="found-profiles w-75 mr-5">
        <?= \yii\widgets\ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_index_profile',
                'layout' => '<div>{summary}</div><div class="mt-3 w-100">{items}</div>{pager}',
                'itemOptions' => [
                    'tag' => false,
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
                'summary' => 'Found <b>{totalCount}</b> users',

            ]
        ) ?>
    </div>
    <div class="mt-5">
        <?= $this->render('_search', ['model' => $searchModel]); ?>
    </div>
</div>