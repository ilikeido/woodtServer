<?php

namespace api\controllers;

use Yii;
use yii\data\Pagination;
use api\models\DemandArea;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TestController implements the CRUD actions for Test model.
 */
class DemandController extends Controller
{

    public function actionArea()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $sql = "select name from demand-area where 1";
        $areas = DemandArea::find()->all();
        $items = $areas;//['some', 'array', 'of', 'data' => ['associative', 'array']];
        return $items;
    }

    public function actionList()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $items = ['some', 'array', 'of', 'data' => ['associative', 'array']];
        return $items;
    }

}
