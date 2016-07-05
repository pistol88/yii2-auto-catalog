<?php
namespace pistol88\autocatalog;

use yii;

class Module extends \yii\base\Module
{
    public $adminRoles = ['admin', 'superadmin'];

    public function init()
    {
        parent::init();
    }
}