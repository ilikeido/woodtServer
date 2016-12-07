<?php

namespace api\controllers;

use common\models\User;
use Yii;
use yii\data\Pagination;
use api\models\UserTag;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use api\controllers\BaseController;
use api\services\UserAccountService;
/**
 * TestController implements the CRUD actions for Test model.
 */
class NewsController extends BaseController
{
    /*
     * 获取新闻列表
     */
    public function actionGetlist()
    {
        return ['code'=>0,'msg'=>"",'time'=>time(),'data'=>[]];

    }

    /*
     * 获取新闻列表
     */
    public function actionDetail()
    {
        return ['code'=>0,'msg'=>"",'time'=>time(),'data'=>[]];

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

}
