<?php

namespace api\controllers;

use api\models\Review;
use api\services\UserAttentionService;
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
class UserAttentionController extends BaseController
{
    /*
     * 是否已关注某人
     */
    public function actionExists()
    {
        $tid = Yii::$app->request->post('tid');
        $userInfo = $this->getUserBySessionToken();
        if ($userInfo !=null){
            $serivce = new UserAttentionService();
            return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>$serivce->attentionIsExits($userInfo['uid'],$tid)];
        }
        return  ['code'=>2,'msg'=>'没有找到用户','time'=>time()];
    }


    /*
     * 是否已关注某人
     */
    public function actionAdd()
    {
        $tid = Yii::$app->request->post('tid');
        $userInfo = $this->getUserBySessionToken();
        $serivce = new UserAttentionService();
        if ($userInfo !=null){
            return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>$serivce->addAttention($userInfo['uid'],$tid)];
        }
        return  ['code'=>2,'msg'=>'没有找到用户','time'=>time()];
    }

    /*
     * 是否已关注某人
     */
    public function actionDel()
    {
        $tid = Yii::$app->request->post('tid');
        $userInfo = $this->getUserBySessionToken();
        $serivce = new UserAttentionService();
        if ($userInfo !=null){
            return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>$serivce->delAttention($userInfo['uid'],$tid)];
        }
        return  ['code'=>2,'msg'=>'没有找到用户','time'=>time()];
    }



}
