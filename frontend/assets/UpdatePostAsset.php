<?php


namespace frontend\assets;


use yii\web\AssetBundle;

class UpdatePostAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        'js/update-post.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        PostAsset::class,
    ];
}