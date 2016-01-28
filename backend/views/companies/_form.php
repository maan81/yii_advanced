<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use backend\controllers\BranchesController;
// use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Companies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-form">

	<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($company, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($company, 'company_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($company, 'company_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($company, 'file')->fileInput() ?>

    <?= $form->field($company, 'company_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => 'Select']) ?>

    <?= $form->field($branch, 'branch_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($branch, 'branch_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($branch, 'branch_status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', ], ['prompt' => 'Select']) ?>

    <div class="form-group">
        <?= Html::submitButton($company->isNewRecord ? 'Create' : 'Update', ['class' => $company->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>