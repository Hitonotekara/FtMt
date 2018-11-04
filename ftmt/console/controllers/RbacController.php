<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 04.11.2018
 * Time: 20:50
 */

namespace console\controllers;

use yii\console\Controller;

class RbacController extends Controller
{
    protected $ids;

    public function actionAssignAdmin()
    {
        $this->proceed('Administrator');
    }

    public function actionAssignOper()
    {
        $this->proceed('Operator');
    }

    protected function proceed($name)
    {
        $this->ids = explode(',', current(\Yii::$app->requestedParams));

        if (empty($this->ids)) {

            throw new \Exception('Не получены параметры');
        }

        $auth = new \custom\rbac\authManager();
        $role = $auth->customGetItem($name);

        foreach ($this->ids as $id)
        {
            if ($id == false) {

                echo 'Произошла ошибка назначения роли - получен пустой (нулевой) ID' . "\n";
                continue;
            }

            $auth->assign($role, (int)$id);
            echo 'Роль ' . $name . ' назначена пользователю с ID=' . $id . "\n";
        }
    }
}