<?php

namespace api\controllers;

use api\models\Review;
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
class ReviewController extends BaseController
{
    /*
     * 获取回复列表
     */
    public function actionGetlist()
    {
        $type = \yii::$app->request->post('type');
        $id = \yii::$app->request->post('id');
        $p = \yii::$app->request->post('p');
        $service = new ReviewService();
        return ['code'=>0,'msg'=>'','time'=>time(),'data'=>$service->getPage($type,$p,$id)];
//        $userinfo = $this->getUserBySessionToken();
//        if ($userinfo != null){
//            $query = (new Query())->select(['demand_tag.name AS name']) -> from('demand_tag')-> leftJoin('user_tag','user_tag.tagid = demand_tag.id')->where(['user_tag.uid'=>$userinfo['uid']]) ;
//            $tags = $query->all();
//            return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>$tags];
//        }
//        return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>[]];
    }


    /*
     * 增加评论
     */
    public function actionAdd(){
        $type = \yii::$app->request->post('type');
        $id = \yii::$app->request->post('id');
        $content = \yii::$app->request->post('content');
        $userinfo = $this->getUserBySessionToken();
        $model = new Review();
        $model->type = $type;
        $model->source_id = $id;
        $model->content = $content;
        $model->uid = $userinfo['uid'];
        $model->nickname = $userinfo['nickname'];
        $model->avatar = $userinfo['avatar'];
        if ($model->validate() && $model->save()){
            return ['code'=>0,'msg'=>'','time'=>time()];
        }else{
            return  ['code'=>2,'msg'=>$model->getErrors(),'time'=>time()];
        }
    }


}
