<?php

use yii\helpers\Html;
use yii\helpers\StringHelper;
/* @var $this yii\web\View */
/* @var $model common\models\Post */

\frontend\assets\UpdatePostAsset::register($this);
$this->title = 'Update Post: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => StringHelper::truncate($model->title, 10,''), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="post-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
