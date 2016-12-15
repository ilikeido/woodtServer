<?php

namespace api\controllers;

use api\models\Review;
use api\services\DemandService;
use api\services\DynamicService;
use api\services\NewsService;
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
class UserCollectionController extends BaseController
{
    /*
     * 是否已收藏信息
     */
    public function actionExists()
    {
        $tid = Yii::$app->request->post('tid');
        $channel = Yii::$app->request->post('channel');
        $userInfo = $this->getUserBySessionToken();
        if ($userInfo !=null){
            return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>UserCollectionService::collectionIsExits($userInfo['uid'],$tid,$channel)];
        }
        return  ['code'=>2,'msg'=>'未登录','time'=>time()];
    }

    /*
     * 是否已关注某人
     */
    public function actionAdd()
    {
        $tid = Yii::$app->request->post('tid');
        $channel = Yii::$app->request->post('channel');
        $title = '';
        if ($channel === 'demand'){
           $demand = DemandService::getDemandById($tid);
            if ($demand != null){
                $title = $demand['title'];
            }else{
                return ['code'=>2,'msg'=>'没有找到供求信息','time'=>time()];
            }
        }else if($channel === 'news'){
            $news = NewsService::findOne($tid);
            $title = $news['title'];
        }else if($channel === 'dynamic'){
            $dynamic = DynamicService::findOne($tid);
            $title = $dynamic['title'];
        }
        $userInfo = $this->getUserBySessionToken();
        if ($userInfo !=null){
            $uid = $userInfo['uid'];
            UserCollectionService::addCollection($uid,$tid,$channel,$title);
            return  ['code'=>0,'msg'=>'','time'=>time()];
        }
        return  ['code'=>2,'msg'=>'没有找到用户','time'=>time()];
    }

    /*
     * 是否已关注某人
     */
    public function actionDel()
    {
        $tid = Yii::$app->request->post('tid');
        $channel = Yii::$app->request->post('channel');
        $userInfo = $this->getUserBySessionToken();
        $serivce = new UserCollectionService();
        if ($userInfo !=null){
            $serivce->delCollection($userInfo['uid'],$tid,$channel);
            return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>0];
        }
        return  ['code'=>2,'msg'=>'没有找到用户','time'=>time()];
    }

    public function actionGetlist(){
        $p = Yii::$app->request->post('p');
        $query = UserCollectionService::find()->select(['uid','tid','channel','create_time','title']);
        $pagination = new Pagination([
                'totalCount' =>$query->count(),
                'pageSize' => '30',
                'pageParam' => 'p',
            ]
        );
        $pagination->page = $p-1;
        $query = $query->offset($pagination->offset)->limit($pagination->limit);
        $query->orderBy('id desc');
        $data = $query->all();
        return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>['data'=>$data,'p'=>$p,'pagesize'=>$pagination->pageSize,'total'=>$pagination->totalCount]];
    }

}
