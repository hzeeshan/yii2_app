<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        // create "importPractices" permission
        $importPractices = $auth->createPermission('importPractices');
        $importPractices->description = 'Import Practices';
        $auth->add($importPractices);

        // create "admin" role, & assign him "importPractices" permission
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $importPractices);

        $user = $auth->createRole('demo');
        $auth->add($user);

        // Assign role admin to user
        $auth->assign($admin, 100);
    }
}