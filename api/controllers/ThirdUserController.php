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
use api\services\AdvertService;
/**
 * TestController implements the CRUD actions for Test model.
 */
class ThirdUserController extends BaseController
{
    /*
     * 获取广告列表
     */
    public function actionLogin()
    {
        $type = Yii::$app->request->post('weixin');
        $openid = Yii::$app->request->post('openid');
        $openid_2 = Yii::$app->request->post('openid_2');
        $token = Yii::$app->request->post('token');

        return ['code'=>0,'msg'=>"",'time'=>time(),'data'=>[]];

    }


}
