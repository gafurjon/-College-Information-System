<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Идораи истифодабарандагон';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persons-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Persons', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_persons',
            'login',
            'password',
            'user_id',
            'telefon',
            // 'name',
            // 'surname',
            // 'middle_name',
            // 'brithday',
            // 'gender',
            // 'id_regions',
            // 'id_zoning',
            // 'adress',
            // 'picture:ntext',
            // 'persons_status',
            // 'id_nation',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
