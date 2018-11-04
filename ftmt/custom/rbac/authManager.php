<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 04.11.2018
 * Time: 21:14
 */

namespace custom\rbac;

class authManager extends \yii\rbac\DbManager
{
    public function customGetItem($name)
    {
        return $this->getItem($name);
    }
}