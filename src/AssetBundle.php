<?php
/**
 * Created by daigangbo.
 * User: daigangbo daigangbo@gmail.com
 * Date: 5/28/16
 * Time: 23:02
 */

namespace gangbo\dbschema;


class AssetBundle extends \yii\web\AssetBundle
{

    public $sourcePath = (__DIR__) . '/assets';
    public $css = [
    ];
    public $js = [
        'js/dbschema.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];

    public function init()
    {
        parent::init();
    }
}