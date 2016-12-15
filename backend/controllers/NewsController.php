<?php

namespace backend\controllers;

use backend\models\NewsTag;
use Yii;
use yii\data\Pagination;
use backend\models\News;
use backend\models\NewsCategory;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NewsController implements the CRUD actions for News model.
 */
class NewsController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all News models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = News::find();
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

        $categorys = NewsCategory::find()->all();
        $categoryDatas = array();
        foreach ($categorys as $item){
            $categoryDatas[$item['id']] = $item['title'];
        }

        $tags = NewsTag::find()->all();
        $tagDatas = array();
        foreach ($tags as $item){
            $tagDatas[$item['id']] = $item['name'];
        }

        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
            'categorys'=>$categoryDatas,
            'tags'=>$tagDatas
        ]);
    }

    /**
     * Displays a single News model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());

    }

    /**
     * Creates a new News model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new News();
        if ($model->load(Yii::$app->request->post())) {
        
              if(empty($model->create_time) == true){
                  $model->create_time = 'CURRENT_TIMESTAMP';
              }
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
     * Updates an existing News model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) {
        
              $model->create_time = 'CURRENT_TIMESTAMP';
              $model->flag = 1;
        
        
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

    /*
     * 设置推荐
     */
    public function actionPos($id){
        if (empty($id) == false){
            $model = $this->findModel($id);
            if ($model != null){
                $pos = $model['pos'];
                if ($pos === 1){
                    $model['pos'] = 0;
                }else{
                    $model['pos'] = 1;
                }
            }
            $model->save();
            echo json_encode(array('errno'=>0, 'msg'=>'','pos'=>$model['pos']));
        }else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    }

    /*
     * 设置禁用
     */
    public function actionDisable($id){
        if (empty($id) == false){
            $model = $this->findModel($id);
            if ($model != null){
                $pos = $model['flag'];
                if ($pos === 1){
                    $model['flag'] = 0;
                }else{
                    $model['flag'] = 1;
                }
            }
            $model->save();
            echo json_encode(array('errno'=>0, 'msg'=>'','pos'=>$model['flag']));
        }else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = News::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    
  
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
