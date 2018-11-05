<?php

use yii\db\Migration;

/**
 * Class m181105_073124_add_permissions_for_City
 */
class m181105_073124_add_permissions_for_City extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = new \custom\rbac\authManager();

        // добавляем разрешения
        $createCity = $auth->createPermission('createCity');
        $createCity->description = 'Create City';
        $auth->add($createCity);

        $switchCity = $auth->createPermission('switchCity');
        $switchCity->description = 'Enable/disable City';
        $auth->add($switchCity);

        $editCity = $auth->createPermission('editCity');
        $editCity->description = 'Edit City';
        $auth->add($editCity);

        $viewCity = $auth->createPermission('viewCity');
        $viewCity->description = 'View list and details of City';
        $auth->add($viewCity);

        $apiGetCity = $auth->createPermission('apiGetCity');
        $apiGetCity->description = 'Get info about Cities by API';
        $auth->add($apiGetCity);

        // добавляем роли
        $admin = $auth->customGetItem('Administrator');
        $oper = $auth->customGetItem('Operator');
        $apiGetter = $auth->customGetItem('ApiServiceGetter');

        // назначаем ролям разрешения
        $auth->addChild($admin, $createCity);
        $auth->addChild($admin, $switchCity);

        $auth->addChild($oper, $editCity);
        $auth->addChild($oper, $viewCity);

        $auth->addChild($apiGetter, $apiGetCity);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181105_073124_add_permissions_for_City cannot be reverted.\n";
    }

}
