<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\BranchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Branches', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin();?>
    <?= GridView::widget([
        'rowOptions' => function($model, $key, $index, $grid){ // ?? how $model gets its values ????????????
                // echo PHP_EOL;
                // echo PHP_EOL;
                // echo PHP_EOL;
                // echo PHP_EOL;
                // echo PHP_EOL;

                // echo 'model : ';
                // print_r($model);
                // echo PHP_EOL;

                // echo 'key : ';
                // print_r($key);
                // echo PHP_EOL;

                // echo 'index : ';
                // print_r($index);
                // echo PHP_EOL;

                // echo 'grid : ';
                // print_r($grid);
                // echo PHP_EOL;

            if($model->branch_status == 'inactive'){
                return ['class' => 'danger'];
            }else{
                return ['class' => 'success'];
            }
        },
        // 'rowOptions' => ['c'=>'CC'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'branch_name',
            'branch_address',
            // 'companiesCompany.company_name',
            [
                'attribute' => 'companies_company_id',
                'value' => 'companiesCompany.company_name'
            ],

            ['class' => 'yii\grid\ActionColumn'],

            'branch_status',
        ],
    ]); ?>
    <?php Pjax::end();?>

</div>
