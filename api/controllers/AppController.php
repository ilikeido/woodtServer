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
class AppController extends BaseController
{
    /*
     * 获取广告列表
     */
    public function actionUpdate()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        Yii::$app->response->headers->set('Content-Type', 'application/javascript; charset=utf-8');
        $models = [
            'app_start_page'=>'widget://index.html',
            'woodinglobal_start_page'=>'widget://html/woodinglobal.html',
            'task_start_page'=>'',
            'app_examine_status'=>'off'
        ];
        return $this->render('index', [
            'models'=>$models,
            'root'=>'widget://index.html'
        ]);
    }

}
