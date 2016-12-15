<?php

namespace api\controllers;

use api\services\DemandService;
use api\services\DemandAreaService;
use Yii;
use yii\data\Pagination;
use api\models\DemandArea;
use api\models\DemandCategory;
use api\models\DemandGroup;
use api\models\DemandTag;
use api\models\Demand;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use api\controllers\BaseController;

/**
 * TestController implements the CRUD actions for Test model.
 */
class NotifyController extends BaseController
{

    /*
     * 获取通知个数
     */
    public function actionNotifycount(){
        return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>0];
    }

    /*
     * 获取通知内容
     */
    public function actionGetlist(){

    }

}
