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
class UserTagController extends BaseController
{
    /*
     * 获取用户标签列表
     */
    public function actionGetlist()
    {
        return ['code'=>0,'msg'=>'','time'=>time()];
//        $userinfo = $this->getUserBySessionToken();
//        if ($userinfo != null){
//            $query = (new Query())->select(['demand_tag.name AS name']) -> from('demand_tag')-> leftJoin('user_tag','user_tag.tagid = demand_tag.id')->where(['user_tag.uid'=>$userinfo['uid']]) ;
//            $tags = $query->all();
//            return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>$tags];
//        }
//        return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>[]];
    }


}
