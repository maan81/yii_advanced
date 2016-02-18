<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\export\ExportMenu;

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
        <?= Html::button(
            'Create Branches',
            [
                'value' => Url::to('index.php?r=branches/create'),
                'class' => 'btn btn-success',
                'id' => 'modalButtom'
            ]
        ) ?>
    </p>

    <?php
        Modal::begin([
                'header' => '<h2>New Branch</h2>',
                'id' => 'modal',
                'size' => 'modal-lg',
            ]
        );

        echo '<div id="modalContent"></div>';

        Modal::end();
    ?>

    <?php

        echo ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'branch_name',
                'branch_address',
                'branch_created_date',
                'branch_status',
            ],
        ]);

    ?>


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
        'pjax' => true,
        'export' => false,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'branch_name',
            ],

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

</div>
