<?php

namespace api\controllers;

use api\models\Seek;
use api\services\SeekService;
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
class SeekController extends BaseController
{
    /*
     * 求购
     */
    public function actionAdd()
    {
        $content = Yii::$app->request->post('content');
        $mobile = Yii::$app->request->post('mobile');
        $seek = new Seek();
        $seek->mobile = $mobile;
        $seek->content = $content;
        $userInfo = $this->getUserBySessionToken();
        if ($userInfo){
            $seek->uid = $userInfo['uid'];
        }
        $seek->save();
        return ['code'=>0,'msg'=>"",'time'=>time()];
    }

}
