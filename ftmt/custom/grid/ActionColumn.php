<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 05.11.2018
 * Time: 14:42
 */

namespace custom\grid;

class ActionColumn extends \yii\grid\ActionColumn
{
    /**
     * Initializes the default button rendering callbacks.
     */
    protected function initDefaultButtons()
    {
        $this->initDefaultButton('view', 'eye-open');
        $this->initDefaultButton('update', 'pencil');

        if (\Yii::$app->user->can('deleteService')) {
            $this->initDefaultButton('delete', 'trash', [
                'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'data-method' => 'post',
            ]);
        }
    }

}