<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button(
            'Create Event',
            [
                'value' => Url::to('index.php?r=events/create'),
                'class' => 'btn btn-success',
                'id' => 'modalButton'
            ]
        ) ?>
    </p>

    <?php
        Modal::begin([
                'header' => '<h2>New Event</h2>',
                'id' => 'modal',
                'size' => 'modal-lg',
            ]
        );

        echo '<div id="modalContent"></div>';

        Modal::end();
    ?>










    <?= \yii2fullcalendar\yii2fullcalendar::widget([
            'events' => $events,

          // 'options' => [
          //   'lang' => 'de',
          //   ... more options to be defined here!
          // ],
          // 'ajaxEvents' => Url::to(['/timetrack/default/jsoncalendar'])
        ]);
    ?>

</div>
