<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\Locations;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model backend\models\Customers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zip_code')->widget( Select2::classname(), [
        'data' => ArrayHelper::map(Locations::find()->all(),'location_id','zip_code'),
        'language' => 'Select a Zip Code',
        'hideSearch' => true,
        'options' => ['placeholder' =>  'Select a Zip Code'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'province')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$script = <<< JS
    $(document).on('change','#customers-zip_code',function(){

        $.get('index.php?r=locations/get-city-province',{zipId:$(this).val()},function(data){

            data = JSON.parse(data);

            $('#customers-city').val(data.city);
            $('#customers-province').val(data.province);
        });

    });
JS;
$this->registerJs($script);
?>