<?php

namespace app\modules\admin;

class AdminModules extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\admin\controllers';

    public function init()
    {
        parent::init();
        $this->layout = 'main';
        // custom initialization code goes here
    }
}
