<?php

use yii\db\Migration;

/**
 * Handles the creation of table `history_service`.
 * Has foreign keys to the tables:
 *
 * - `service`
 * - `user`
 */
class m181104_205429_create_history_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('history_service', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer(),
            'property' => $this->string(),
            'prev_value' => $this->string(),
            'new_value' => $this->string(),
            'date_modify' => $this->timestamp(),
            'user_id' => $this->integer(),
        ]);

        // creates index for column `entity_id`
        $this->createIndex(
            'idx-history_service-entity_id',
            'history_service',
            'entity_id'
        );

        // add foreign key for table `service`
        $this->addForeignKey(
            'fk-history_service-entity_id',
            'history_service',
            'entity_id',
            'service',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-history_service-user_id',
            'history_service',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-history_service-user_id',
            'history_service',
            'user_id',
            'user',
            'id',
            'RESTRICT'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `service`
        $this->dropForeignKey(
            'fk-history_service-entity_id',
            'history_service'
        );

        // drops index for column `entity_id`
        $this->dropIndex(
            'idx-history_service-entity_id',
            'history_service'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-history_service-user_id',
            'history_service'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-history_service-user_id',
            'history_service'
        );

        $this->dropTable('history_service');
    }
}
