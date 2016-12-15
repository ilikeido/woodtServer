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
class AdController extends BaseController
{
    /*
     * 获取广告列表
     */
    public function actionGetlist()
    {
        $name = Yii::$app->request->post('name');
        $os = Yii::$app->request->post('os');
        $query = AdvertService::find()->select(['id','title','level','description','banner_url','goto','record_id'])->asArray();
        if (!empty($name)){
            $query->where(['category_name'=>$name]);
        }
        $query->orderBy('level desc,id desc');
        $ads = $query->all();
        return ['code'=>0,'msg'=>"",'time'=>time(),'data'=>$ads];

    }

    /*
     * 获取新闻列表
     */
    public function actionDetail()
    {
        return ['code'=>0,'msg'=>"",'time'=>time(),'data'=>[]];

    }

}
