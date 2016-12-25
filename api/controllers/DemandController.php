<?php

namespace api\controllers;

use api\services\CacheService;
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
        $areas = DemandAreaService::getAllAreaNames();
        $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>$areas];
        return $result;
    }


    /*
     * 获取类别数据字典
     */
    public  function actionGetAllCategoryAndTag(){
        $cache = Yii::$app->cache;
        $key = CacheService::CACHEKEY_GET_CATORY_AND_TAG;
        if(!$cache->exists($key)){
            $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>DemandService::getCatorysAndTag()];
            $dependency = new \yii\caching\ExpressionDependency(
                ['expression'=> '\api\services\CacheService::getDependencyValue(\api\services\CacheService::CACHEKEY_GET_CATORY_AND_TAG)']
            );
            $cache->add($key,$result,0,$dependency);
            return $result;
        }else if ($cache->get($key) == null){
            $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>DemandService::getCatorysAndTag()];
            $dependency = new \yii\caching\ExpressionDependency(
                ['expression'=> '\api\services\CacheService::getDependencyValue(\api\services\CacheService::CACHEKEY_GET_CATORY_AND_TAG)']
            );
            $cache->set($key,$result,0,$dependency);
            return $result;
        }else{
            $value = $cache->get(CacheService::CACHEKEY_GET_CATORY_AND_TAG);
            return $value;
        }
    }

    /*
     * 获取类别数据字典
     */
    public  function actionGetallcategory(){
        $cache = Yii::$app->cache;
        $key = CacheService::CACHEKEY_GET_ALL_CATORYS;
        if(!$cache->exists($key)){
            $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>DemandService::getAllcatorys()];
            $dependency = new \yii\caching\ExpressionDependency(
                ['expression'=> '\api\services\CacheService::getDependencyValue(\api\services\CacheService::CACHEKEY_GET_ALL_CATORYS)']
            );
            $cache->add($key,$result,0,$dependency);
            return $result;
        }else if ($cache->get($key) == null){
            $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>DemandService::getAllcatorys()];
            $dependency = new \yii\caching\ExpressionDependency(
                ['expression'=> '\api\services\CacheService::getDependencyValue(\api\services\CacheService::CACHEKEY_GET_ALL_CATORYS)']
            );
            $cache->set($key,$result,0,$dependency);
            return $result;
        }else{
            $value = $cache->get(CacheService::CACHEKEY_GET_ALL_CATORYS);
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
        $pagedata = DemandService::getPage($root,$p,null,$category,$group,$tag,$area,$order);
        $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>$pagedata];
        return $result;
    }

    /*
     * 获取供求详情
     */
    public function actionDetail(){
        $id = Yii::$app->request->post('id');
        $demand = DemandService::getDetail($id);
        if ($demand != null){
            $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>$demand];
            $model = DemandService::findOne($id);
            $model['view'] = $model['view'] + 1;
            $model->save();
            return $result;
        }
        return ['code'=>2,'msg'=>'找不到该数据','time'=>time()];
    }

    /*
    * 获取列表
    */
    public function actionGettags(){
        $category = Yii::$app->request->post('category');
        $group = Yii::$app->request->post('group');
        $tags = DemandService::getTags($category,$group);
        $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>$tags];
        return $result;
    }

    /*
     * 获取用户的供求信息
     */
    public function actionGetlistbyuid(){
        $uid = Yii::$app->request->post('uid');
        $root = Yii::$app->request->post('root');
        $p = Yii::$app->request->post('p');
        $result = DemandService::getPage($root,$p,$uid);
        return ['code'=>0,'msg'=>'','time'=>time(),'data'=>$result];
    }




}
