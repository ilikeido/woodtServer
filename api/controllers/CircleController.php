<?php

namespace api\controllers;

use api\services\CircleService;
use api\services\UserEvendataService;
use common\models\User;
use Yii;
use yii\data\Pagination;
use api\models\DemandArea;
use api\models\Demand;
use api\models\DemandCategory;
use api\models\DemandGroup;
use api\models\DemandTag;
use api\models\UserAccount;
use api\models\UserPhonemsg;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use api\controllers\BaseController;
use api\services\UserAccountService;
/**
 * TestController implements the CRUD actions for Test model.
 */
class CircleController extends BaseController
{
    public function actionGetlist(){

        $query = UserEvendataService::find()->select(['uid','nickname','avatar','product','contact','last_update_time','level_number','dynamic_id','demand_count', 'dynamic_count']);
        $p = Yii::$app->request->post('p');
        $tag = Yii::$app->request->post('tag');
        if (!empty($tag)){

        }

        $query->orderBy('last_update_time DESC');

    }

}
