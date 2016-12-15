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
use api\services\NewsCategoryService;
use api\services\NewsTagService;
use api\services\NewsService;
use api\services\BaseService;


/**
 * TestController implements the CRUD actions for Test model.
 */
class NewsController extends BaseController
{
    /*
     * 获取新闻列表
     */
    public function actionGetlist()
    {
        $p = Yii::$app->request->post('p');
        $category = Yii::$app->request->post('category');
        $tag = Yii::$app->request->post('tag');
        $pagedata = NewsService::getPage($p,$category,$tag);
        $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>$pagedata];
        return $result;

    }

    /*
     * 获取新闻列表
     */
    public function actionDetail()
    {
        $id = Yii::$app->request->post('id');
        $new =  NewsService::find()->select(['id','title','view','create_time','cover_thumb_url','parse_content'])->asArray()->one();
        $createtimeFormat = BaseService::format_date(strftime($new['create_time']));
        $new['create_time_format'] = $createtimeFormat;
        return ['code'=>0,'msg'=>"",'time'=>time(),'data'=>$new];

    }

    /*
     * 获取类别数据字典
     */
    public  function actionGetallcategory(){
        $cache = Yii::$app->cache;
        $value = false;//$cache->get('AllCatoryAndTag');
        if($value == false){
            $categorys = NewsCategoryService::find()->select(['id','name','title'])->asArray()->all();
            $tags = NewsTagService::find()->select(['name'])->all();
            foreach ($categorys as &$category){
                $category['tags'] = $tags;
            }
            $result = ['code'=>0,'msg'=>'','time'=>time(),'data'=>$categorys];
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
