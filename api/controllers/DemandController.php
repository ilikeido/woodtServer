<?php

namespace api\controllers;

use Yii;
use yii\data\Pagination;
use api\models\DemandArea;
use api\models\DemandCategory;
use api\models\DemandGroup;
use api\models\DemandTag;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

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

    public  function actionAllCatoryAndTag(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $cache = Yii::$app->cache;
        $value = false;//$cache->get('AllCatoryAndTag');
        if($value == false){
            $categories = DemandCategory::find(['select'=>['id','title']])->where(['flag'=>1])->orderBy('sort')->asArray()->all();
            $groups = DemandGroup::find()->where(['flag'=>1])->orderBy('category_id,sort')->asArray()->all();
            $tags = DemandTag::find()->where(['flag'=>1])->orderBy('group_id,sort')->asArray()->all();
            $resultGroups = array();
            $resultCategories = array();
            foreach ($groups as $_group){
                $tempTagArray = array();
                foreach ($tags as $tag){
                    if ($_group['id'] == $tag['group_id']){
                        ArrayHelper::remove($tag, 'group_id');
                        ArrayHelper::remove($tag, 'flag');
                        ArrayHelper::remove($tag, 'sort');
                        array_push($tempTagArray,$tag);
                    }
                }
                $_group['tags'] = $tempTagArray;
                array_push($resultGroups,$_group);
            }
            foreach ($categories as $_category){
                $tempGroupArray = array();
                foreach ($resultGroups as $group){
                    if ($_category['id'] == $group['category_id']){
                        ArrayHelper::remove($group, 'category_id');
                        ArrayHelper::remove($group, 'flag');
                        ArrayHelper::remove($group, 'sort');
                        array_push($tempGroupArray,$group);
                    }
                }
                $_category['group'] = $tempGroupArray;
                ArrayHelper::remove($_category, 'flag');
                ArrayHelper::remove($_category, 'sort');
                array_push($resultCategories,$_category);
            }
            $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>$resultCategories];
//            $dependency = new \yii\caching\ExpressionDependency(
//                ['expression'=> $cache->get('category-group-tag-updateTime')]
//            );
//            $cache->add('AllCatoryAndTag',$result,0,$dependency);
            return $result;
        }else{
            return $value;
        }

    }

}
