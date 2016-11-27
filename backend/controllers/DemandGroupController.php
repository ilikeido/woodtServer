<?php

namespace backend\controllers;

use Yii;
use yii\data\Pagination;
use backend\models\DemandGroup;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DemandGroupController implements the CRUD actions for DemandGroup model.
 */
class DemandGroupController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all DemandGroup models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $query = DemandGroup::find()->andWhere(['category_id' => $id]);
        $querys = Yii::$app->request->get('query');

        if(count($querys) > 0){
            $condition = "";
            $parame = array();
            foreach($querys as $key=>$value){
                $value = trim($value);
                if(empty($value) == false){
                    $parame[":{$key}"]=$value;
                    if(empty($condition) == true){
                        $condition = " {$key}=:{$key} ";
                    }
                    else{
                        $condition = $condition . " AND {$key}=:{$key} ";
                    }
                }
            }
            if(count($parame) > 0){
                $query = $query->where($condition, $parame);
            }
        }

        $pagination = new Pagination([
            'totalCount' =>$query->count(), 
            'pageSize' => '10', 
            'pageParam'=>'page', 
            'pageSizeParam'=>'per-page']
        );
        
        $orderby = Yii::$app->request->get('orderby', '');
        if(empty($orderby) == false){
            $query = $query->orderBy($orderby);
        }
        
        
        $models = $query
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
            'category_id'=>$id
        ]);
    }

    /**
     * Displays a single DemandGroup model.
     * @param integer $id
     * @param integer $category_id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());

    }

    /**
     * Creates a new DemandGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DemandGroup();
        if ($model->load(Yii::$app->request->post())) {
        
              if(empty($model->flag) == true){
                  $model->flag = 1;
              }
        
            if($model->validate() == true && $model->save()){
                $msg = array('errno'=>0, 'msg'=>'保存成功');
                echo json_encode($msg);
            }
            else{
                $msg = array('errno'=>2, 'data'=>$model->getErrors());
                echo json_encode($msg);
            }
        } else {
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            echo json_encode($msg);
        }
    }

    /**
     * Updates an existing DemandGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $category_id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {

            if($model->validate() == true && $model->save()){
                $msg = array('errno'=>0, 'msg'=>'保存成功');
                echo json_encode($msg);
            }
            else{
                $msg = array('errno'=>2, 'data'=>$model->getErrors());
                echo json_encode($msg);
            }
        } else {
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            echo json_encode($msg);
        }
    
    }

    /**
     * Deletes an existing DemandGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $category_id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = DemandGroup::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    
  
    }

    /**
     * Finds the DemandGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $category_id
     * @return DemandGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DemandGroup::findOne(['id' => $id,])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
