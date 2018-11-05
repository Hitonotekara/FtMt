<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "history_service".
 *
 * @property int $id
 * @property int $entity_id
 * @property string $property
 * @property string $prev_value
 * @property string $new_value
 * @property string $date_modify
 * @property int $user_id
 *
 * @property User $user
 * @property Service $entity
 */
class HistoryService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'history_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_id', 'user_id'], 'integer'],
            [['date_modify'], 'safe'],
            [['property', 'prev_value', 'new_value'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['entity_id'], 'exist', 'skipOnError' => true, 'targetClass' => Service::className(), 'targetAttribute' => ['entity_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_id' => 'Entity ID',
            'property' => 'Property',
            'prev_value' => 'Prev Value',
            'new_value' => 'New Value',
            'date_modify' => 'Date Modify',
            'user_id' => 'User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntity()
    {
        return $this->hasOne(Service::className(), ['id' => 'entity_id']);
    }
}
