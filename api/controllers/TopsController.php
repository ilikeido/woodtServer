<?php

namespace api\controllers;

use api\services\DemandService;
use api\services\DynamicService;
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
use api\services\NewsCategoryService;
use api\services\NewsTagService;
use api\services\NewsService;
use api\services\BaseService;


/**
 * TestController implements the CRUD actions for Test model.
 */
class TopsController extends BaseController
{
    /*
     * 获取新闻列表
     */
    public function actionGetlist()
    {
        $p = Yii::$app->request->post('p');
        $category = Yii::$app->request->post('category');
        $tag = Yii::$app->request->post('tag');
        $pagedata = NewsService::getPage($p,$category,$tag);
        $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>$pagedata];
        return $result;

    }

    /*
     * 搜索
     */
    public function actionSearch(){
        $tag = Yii::$app->request->post('tag');
        $os = Yii::$app->request->post('os');
        $news = NewsService::getNewsList(0,4);
        $demands = DemandService::getDemandsWithUserList(0,4);
        $dynamics = DynamicService::getDynmicsWithUserList(0,4);
        $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>['news_list'=>$news,'demand_list'=>$demands,'dynamic_list'=>$dynamics]];
        return $result;
    }


}
