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
        $pagedata = DynamicService::getPage($uid,$p);
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
        if ($type === 'auth'){//关注用户

        }
        $uid = '';
        if ($type === 'attention'){//认证用户
            $userinfo = $this->getUserBySessionToken();
            $uid = $userinfo['uid'];
        }
        $p = Yii::$app->request->post('p');
        $keyword = Yii::$app->request->post('keyword');
        $pagedata = DynamicService::getPage($type,$p,$keyword,$uid);
        $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>$pagedata];
        return $result;

    }

    /**
     * 详情
     */
    public function actionDetail(){
        $id = Yii::$app->request->post('id');
        $dynamic = DynamicService::getDetail($id);
        $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>$dynamic];
        return $result;
    }

}
