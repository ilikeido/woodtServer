<?php

namespace api\controllers;

use api\models\Review;
use api\services\DynamicService;
use api\services\UserCollectionService;
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
use api\services\ReviewService;

/**
 * TestController implements the CRUD actions for Test model.
 */
class DynamicController extends BaseController
{
    /*
     * 获取列表
     */
    public function actionGetlist(){
        $uid = Yii::$app->request->post('uid');
        $p = Yii::$app->request->post('p');
        $dynamicService = new DynamicService();
        $pagedata = $dynamicService->getPage($uid,$p);
        $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>$pagedata];
        return $result;
    }

    /**
     * 搜索
     */
    public function actionSearch(){
        $type = Yii::$app->request->post('type');
        if ($type === 'all'){

        }
        $p = Yii::$app->request->post('p');
        $keyword = Yii::$app->request->post('keyword');
        $dynamicService = new DynamicService();
        $pagedata = $dynamicService->getPage(null,$p,$keyword);
        $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>$pagedata];
        return $result;

    }

}
