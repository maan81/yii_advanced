<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <div class="login-box">
        <a href="../../index2.html">
            <b>Admin</b>LTE
        </a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php $form = ActiveForm::begin(['id'=>'login-form']) ?>
            <?= $form->field($model, 'username',['options'=>[
                        'tag'=>'div',
                        'class'=>'form-group field-loginform-username has-feedback required',
                    ],
                    'template'=>'{input}<span class="glyphicon glyphicon-user form-control-feedback"></span>
                                 {error}{hint}',
                ])->textInput(['placeholder'=>'Username'])?>
            <?= $form->field($model, 'password', ['options' =>[
                        'tag'=>'div',
                        'class'=>'form-group field-loginform-password has-feedback required',
                    ],
                    'template'=>'{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                 {error}{hint}',
                ])->passwordInput(['placeholder'=>'Password'])?>


            <div class="row">
                <?= $form->field($model, 'rememberMe',['options'=>[
                        'class'=>'form-group field-loginform-rememberme col-md-6'
                    ]])->checkbox()
                ?>
                <div class="col-md-6">
                    <?=Html::submitButton('Sign In',['class'=>'btn btn-primary','name'=>'login-button'])?>
                </div>
            </div>


        <?php ActiveForm::end()?>
    </div>
</div>
