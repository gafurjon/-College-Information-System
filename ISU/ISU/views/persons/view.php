<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Persons */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Persons', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="persons-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_persons], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_persons], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_persons',
            'login',
            'password',
            'user_id',
            'telefon',
            'name',
            'surname',
            'middle_name',
            'brithday',
            'gender',
            'id_regions',
            'id_zoning',
            'adress',
            'picture:ntext',
            'persons_status',
            'id_nation',
        ],
    ]) ?>

</div>
