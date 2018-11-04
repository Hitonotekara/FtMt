<?php

use yii\db\Migration;

/**
 * Handles the creation of table `city`.
 */
class m181104_201332_create_city_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('city', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'code' => $this->string(),
            'status' => $this->tinyInteger(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('city');
    }
}
