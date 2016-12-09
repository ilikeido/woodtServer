<?php
namespace api\services;

use api\models\News;
use Faker\Provider\Base;
use \yii\db\Query;
use \yii\helpers\ArrayHelper;
use \yii\data\Pagination;

class NewsService extends News{


    /*
     * 获取供求列表
     */
    public function getPage($p=1,$category='',$tag=''){
        $query = (new Query())->from('news')->select(['id','title','description','cover_thumb_url','view','create_time'])->where(['flag' => 1]);
        if(!empty($category) && !($category === 'news')){
            $query = $query->andWhere(['category'=>$category]);
        }
        if(!empty($tag)){
            $query = $query->andWhere(['tags'=>$tag]);
        }
        $pagination = new Pagination([
                'totalCount' =>$query->count(),
                'pageSize' => '30',
                'pageParam'=>'page',
                'pageSizeParam'=>'per-page']
        );
        $query = $query->offset($pagination->offset)->limit($pagination->limit);
        $result = $query->all();
        foreach ($result as &$item){
            $createtime = $item['create_time'];
            $createtimeFormat = BaseService::format_date(strftime($createtime));
            $item['create_time_format'] = $createtimeFormat;
        }
        return ['pagesize'=>$pagination->getPageSize(),'p'=>$pagination->getPage(),'total'=>$pagination->totalCount,'data'=>$result];
    }
}
