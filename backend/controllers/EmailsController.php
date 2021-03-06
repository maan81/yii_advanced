<?php

namespace backend\controllers;

use Yii;
use backend\models\Emails;
use backend\models\EmailsSearch;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmailsController implements the CRUD actions for Emails model.
 */
class EmailsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Emails models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmailsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Emails model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Emails model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Emails();

        if ($model->load(Yii::$app->request->post())) {
            $model->attachment = UploadedFile::getInstance($model,'attachment');

print_r($_POST);
// print_r($_FILES);
// die;
            if($model->attachment){
                $time = time();
                $model->attachment->saveAs('uploads/'.$time.$model->attachment->extension);
                $model->attachment = 'uploads/'.$time.'.'.$model->attachment->extension;
            }

print_r($model->attachment);
// print_r($_FILES);
die;
            if($model->attachment){
                $value = Yii::$app->mailer->compose()
                    ->setFrom(['asdf@asdf.com'=>'DoingItEasyChannel'])
                    ->setTo($model->reciever_email)
                    ->setSubject($model->subject)
                    ->setHtmlBody($model->conntent)
                    ->attach($model->attachment)
                    ->send();
            }else{
                // $value = Yii::$app->mailer->compose()
                //     ->setFrom(['asdf@asdf.com'=>'DoingItEasyChannel'])
                //     ->setTo($model->reciever_email)
                //     ->setSubject($model->subject)
                //     ->setHtmlBody($model->conntent)
                //     ->send();

            }

            $model->save();
print_r($model->getErrors());
die('y');
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Emails model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Emails model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Emails model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Emails the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Emails::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
