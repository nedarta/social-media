<?php


namespace frontend\assets;


use yii\web\AssetBundle;

class PostAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/post.css',
    ];
    public $js = [
//        'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',
//        'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'
    ];
    public $depends = [
        AppAsset::class
    ];
}