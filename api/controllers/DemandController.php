<?php

namespace api\controllers;

use api\services\DemandService;
use api\services\DemandAreaService;
use Yii;
use yii\data\Pagination;
use api\models\DemandArea;
use api\models\DemandCategory;
use api\models\DemandGroup;
use api\models\DemandTag;
use api\models\Demand;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use api\controllers\BaseController;

/**
 * TestController implements the CRUD actions for Test model.
 */
class DemandController extends BaseController
{

    public function actionIndex(){
    }

    public function actionGetarea()
    {
        $service = new DemandAreaService();
        $areas = $service->getAllAreaNames();
        $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>$areas];
        return $result;
    }


    /*
     * 获取类别数据字典
     */
    public  function actionGetAllCategoryAndTag(){
        $cache = Yii::$app->cache;
        $value = false;//$cache->get('AllCatoryAndTag');
        if($value == false){
            $service = new DemandService();
            $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>$service->getCatorysAndTag()];
            return $result;
        }else{
            return $value;
        }
    }

    /*
     * 获取类别数据字典
     */
    public  function actionGetallcategory(){
        $cache = Yii::$app->cache;
        $value = false;//$cache->get('AllCatoryAndTag');
        if($value == false){
            $service = new DemandService();
            $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>$service->getAllcatorys()];
//            $dependency = new \yii\caching\ExpressionDependency(
//                ['expression'=> $cache->get('category-group-tag-updateTime')]
//            );
//            $cache->add('AllCatoryAndTag',$result,0,$dependency);
            return $result;
        }else{
            return $value;
        }

    }

    /*
     * 获取列表
     */
    public function actionGetlist(){
        $root = Yii::$app->request->post('root');
        $p = Yii::$app->request->post('p');
        $category = Yii::$app->request->post('category');
        $group = Yii::$app->request->post('group');
        $tag = Yii::$app->request->post('tag');
        $area = Yii::$app->request->post('area');
        $order = Yii::$app->request->post('order');
        $demandService = new DemandService();
        $pagedata = $demandService->getPage($root,$p,$category,$group,$tag,$area,$order);
        $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>$pagedata];
        return $result;
    }

    /*
     * 获取供求详情
     */
    public function actionDetail(){
        $id = Yii::$app->request->post('id');
        $demandService = new DemandService();
        $demand = $demandService->getDetail($id);
        $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>$demand];
        return $result;
    }

    /*
    * 获取列表
    */
    public function actionGettags(){
        $category = Yii::$app->request->post('category');
        $group = Yii::$app->request->post('group');
        $demandService = new DemandService();
        $tags = $demandService->getTags($category,$group);
        $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>$tags];
        return $result;
    }





}
