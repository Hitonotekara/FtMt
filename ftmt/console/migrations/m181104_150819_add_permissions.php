<?php

use yii\db\Migration;

/**
 * Class m181104_150819_add_permissions
 */
class m181104_150819_add_permissions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешения
        $createService = $auth->createPermission('createService');
        $createService->description = 'Create Service';
        $auth->add($createService);

        $switchService = $auth->createPermission('switchService');
        $switchService->description = 'Enable/disable Service';
        $auth->add($switchService);

        $editService = $auth->createPermission('editService');
        $editService->description = 'Edit Service';
        $auth->add($editService);

        $viewService = $auth->createPermission('viewService');
        $viewService->description = 'View list and details of Service';
        $auth->add($viewService);

        $viewHistory = $auth->createPermission('viewHistory');
        $viewHistory->description = 'View Changes History';
        $auth->add($viewHistory);

        $apiGetService = $auth->createPermission('apiGetService');
        $apiGetService->description = 'Get info about Services by API';
        $auth->add($apiGetService);

        // добавляем роли
        $admin = $auth->createRole('Administrator');
        $auth->add($admin);

        $oper = $auth->createRole('Operator');
        $auth->add($oper);

        $apiGetter = $auth->createRole('ApiServiceGetter');
        $auth->add($apiGetter);

        // назначаем ролям разрешения
        $auth->addChild($admin, $oper);
        $auth->addChild($admin, $createService);
        $auth->addChild($admin, $switchService);

        $auth->addChild($oper, $editService);
        $auth->addChild($oper, $viewService);
        $auth->addChild($oper, $viewHistory);

        $auth->addChild($apiGetter, $apiGetService);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('auth_item');
        $this->delete('auth_item_child');
    }

}
