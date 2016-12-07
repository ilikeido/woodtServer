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
class TopsController extends BaseController
{
    /*
     * 搜索
     */
    public function actionSearch()
    {
        return ['code'=>0,'msg'=>"",'time'=>time(),'data'=>[]];

    }

}
