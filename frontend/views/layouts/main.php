<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\bootstrap4\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-lg navbar-light bg-light rounded mb-0',
        ],
    ]);
    $menuItems = [
        ['label' => 'Posts', 'url' => ['/post/index']],
        ['label' => 'Users', 'url' => ['/profile/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup'], 'options' => ['class' => 'ml-auto']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
                'label' => Yii::$app->user->identity->username,
                'url' => '#',
                'linkOptions' => [
                    'class' => 'dropdown-toggle',
                    'data-toggle' => 'dropdown',
                    'aria-haspopup' => 'true',
                    'aria-expanded' => 'false',
                    'id' => 'dropdown'],
                'items' => [
//                    ['label' => 'My posts', 'url' => '#'],
                    ['label' => 'Profile', 'url' => ['/profile/view', 'username' => Yii::$app->user->identity->username]],
                    ['label' => 'Logout', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                    ['label' => 'Settings', 'url' => ['/settings']]
//                    ['label' => 'Create Post', 'url' => ['post/create']]
                ],
                'options' => [
                        'class' => 'ml-lg-auto'
                ],
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right w-100'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container d-flex">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <?= Html::a('About', ['/site/about'], ['class' => 'ml-auto mr-2 text-dark text-decoration-none']) ?>
        <?= Html::a('Contact Us', ['/site/contact'], ['class' => 'text-dark text-decoration-none']) ?>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
