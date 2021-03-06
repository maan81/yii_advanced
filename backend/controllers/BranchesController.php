<?php

namespace backend\controllers;

use Yii;
use backend\models\Branches;
use backend\models\BranchesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\helpers\Json;

/**
 * BranchesController implements the CRUD actions for Branches model.
 */
class BranchesController extends Controller
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
     * Lists all Branches models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BranchesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if(Yii::$app->request->post('hasEditable')){
            $branch_id = Yii::$app->request->post('editableKey');
            $branch = Branches::findOne($branch_id);

            $out = Json::encode(['output'=>'','message'=>'']);
            $post = [];
            $posted = current($_POST['Branches']);
            $post['Branches'] = $posted;

            if($branch->load($post)){
                $branch->save();
                $output = 'my value';
            }

            echo $out;
            return;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Branches model.
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
     * Creates a new Branches model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if( Yii::$app->user->can( 'create-branch' )) {
            $model = new Branches();

            if ($model->load(Yii::$app->request->post())) {
                 $model->branch_created_date = date('Y-m-d h:i:s a');
                 $model->save();
                 return $this->redirect(['view', 'id' => $model->branch_id]);
            } else {
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing Branches model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->branch_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Branches model.
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
     * Finds the Branches model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Branches the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Branches::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionList($company_id){


        $countBranches = Branches::find()
            ->where(['companies_company_id' => $company_id])
            ->count();

        $branches = Branches::find()
            ->where(['companies_company_id' => $company_id])
            ->all();

        if($countBranches>0){
            foreach($branches as $branch){
                echo '<option value="'.$branch->branch_id.'">'.$branch->branch_name.'</option>';
            }
        }else{
            echo '<option>Select Branch</option>';
        }
    }

    public function actionImportExcel()
    {
        $inputFile = '/home/maan/Desktop/yii/advanced/uploads/branches_file.xlsx';

        try {

            $inputFileType = \PHPExcel_IOFactory::identify($inputFile);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFile);

        } catch (Exception $e) {
            die('Error ');
        }


        $sheet = $objPHPExcel->getSheet(0);

        $highestRow = $sheet->getHighestRow();

        $highestColumn = $sheet->getHighestColumn();


        for($row=1;$row<=$highestRow;$row++)
        {
            $rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null,true,false);

            // remove 1st column here
            // ..
            // ..
            // ..

            $branch = new Branches();

            $branch->branch_name = $rowData[0][0];
            $branch->branch_address = $rowData[0][1];
            $branch->branch_created_date = $rowData[0][2];
            $branch->branch_status = 'active'/*$rowData[0][3]*/; // fixed. to be improved
            $branch->companies_company_id = 1;                   // fixed. to be improved

            $branch->save();

            print_r($branch->getErrors());
        }

        die;
    }
}
