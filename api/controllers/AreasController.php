<?php

namespace api\controllers;

use Yii;
use yii\data\Pagination;
use api\models\DemandArea;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;

/**
 * TestController implements the CRUD actions for Test model.
 */
class AreasController extends ActiveController
{

    public $modelClass = 'api\models\DemandArea';

//    public function actions()
//    {
//        $actions = parent::actions();
//        // 禁用""index,delete" 和 "create" 操作
//        unset($actions['index']);
//
//        return $actions;
//    }
//
//    public function actionIndex()
//    {
//        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
//        $items = ['some', 'array', 'of', 'data' => ['associative', 'array']];
//        return $items;
//    }


}
