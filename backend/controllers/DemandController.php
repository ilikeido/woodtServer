<?php

namespace backend\controllers;

use backend\services\DemandAreaService;
use backend\services\DemandCategoryService;
use backend\services\DemandGroupService;
use Yii;
use yii\data\Pagination;
use backend\models\Demand;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DemandController implements the CRUD actions for Demand model.
 */
class DemandController extends BaseController
{
	public $layout = "lte_main";

    /**
     * Lists all Demand models.
     * @return mixed
     */
    public function actionIndex()
    {
        $query = Demand::find();
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
        $areas = DemandAreaService::find()->all();
        $areaDatas = array();
        foreach ($areas as $area){
            $areaDatas[$area['id']] = $area['area'];
        }
        $categorys = DemandCategoryService::find()->all();
        $categoryDatas = array();
        foreach ($categorys as $item){
            $categoryDatas[$item['id']] = $item['title'];
        }
        $groupDatas = array();
        $models = $query
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
        return $this->render('index', [
            'models'=>$models,
            'pages'=>$pagination,
            'query'=>$querys,
            'areas'=>$areaDatas,
            'categorys'=>$categoryDatas,
            'groupDatas'=>$groupDatas,
        ]);
    }

    /**
     * Displays a single Demand model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        echo json_encode($model->getAttributes());

    }

    /**
     * Creates a new Demand model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Demand();
        if ($model->load(Yii::$app->request->post())) {
        
              if(empty($model->create_time) == true){
                  $model->create_time = 'CURRENT_TIMESTAMP';
              }
              if(empty($model->number) == true){
                  $model->number = 1000;
              }
              if(empty($model->buy_or_sale) == true){
                  $model->buy_or_sale = 1;
              }
              if(empty($model->flag) == true){
                  $model->flag = 1;
              }
              if(empty($model->sort) == true){
                  $model->sort = 999;
              }

            $category = DemandCategoryService::findOne($model['category_id']);
            $model['category_name'] = $category['name'];
            $model['category_title'] = $category['title'];
            $group = DemandGroupService::findOne($model['group_id']);
            $model['group_title'] = $group['name'];
            $area = DemandAreaService::findOne($model['area']);
            $model['area_title'] = $area['area'];
            if($model->validate() == true && $model->save()){
                $msg = array('errno'=>0, 'msg'=>'保存成功');
                echo json_encode($msg);
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
     * Updates an existing Demand model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        $category_id = $model['category_id'];
        $group_id = $model['group_id'];
        $area_id = $model['area'];
        if ($model->load(Yii::$app->request->post())) {
            if (!($model['category_id'] === $category_id)){
                $category = DemandCategoryService::findOne($model['category_id']);
                $model['category_name'] = $category['name'];
                $model['category_title'] = $category['title'];
            }
            if (!($model['group_id'] === $group_id)){
                $group = DemandGroupService::findOne($model['group_id']);
                $model['group_title'] = $group['name'];
            }
            if (!($model['area'] === $area_id)){
                $area = DemandAreaService::findOne($model['area']);
                $model['area_title'] = $area['area'];
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
     * Deletes an existing Demand model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete(array $ids)
    {
        if(count($ids) > 0){
            $c = Demand::deleteAll(['in', 'id', $ids]);
            echo json_encode(array('errno'=>0, 'data'=>$c, 'msg'=>json_encode($ids)));
        }
        else{
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }
    
  
    }

    /*
     * 获取分类下的组列表
     */
    public function actionGroups($id){
        if (empty($id)){
            echo json_encode(array('errno'=>2, 'msg'=>''));
        }else{
            $groups = DemandGroupService::find()->where(['category_id'=>$id])->andWhere(['flag'=>1])->orderBy('sort,id')->asArray()->all();
            echo json_encode(array('errno'=>0, 'msg'=>'','groups'=>$groups));
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
     * Finds the Demand model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Demand the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Demand::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
