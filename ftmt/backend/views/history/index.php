<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\HistoryServiceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'History Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="history-service-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'entity_id',
            'property',
            'prev_value',
            'new_value',
            'date_modify',
            'user_id',
        ],
    ]); ?>
</div>
