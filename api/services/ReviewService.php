<?php
namespace api\services;

use api\models\Demand;
use api\models\DemandArea;
use api\models\DemandCategory;
use api\models\DemandGroup;
use api\models\Review;
use api\models\UserAccount;
use api\models\UserGroup;
use api\models\UserTag;
use Faker\Provider\Base;
use \yii\db\Query;
use \yii\helpers\ArrayHelper;
use \yii\data\Pagination;

class ReviewService extends Review  {

    /*
     * 获取供求列表
     */
    public function getPage($type,$p=1,$sid){
        $query = (new Query())->from('review')->select(['id','uid','content','nickname','create_time','avatar'])->where(['flag' => 1]);
        if(!empty($type)){
            $query = $query->andWhere(['type'=>$type]);
        }
        if(!empty($sid)){
            $query = $query->andWhere(['source_id'=>$sid]);
        }
        $pagination = new Pagination([
                'totalCount' =>$query->count(),
                'pageSize' => '30',
                'pageParam'=>'p',
                'pageSizeParam'=>'per-page']
        );
        $query = $query->offset($pagination->offset)->limit($pagination->limit);
        $result = $query->all();
        foreach ($result as &$item){
            $item['create_time'] = BaseService::format_date($item['create_time']);
        }
        return ['pagesize'=>$pagination->getPageSize(),'p'=>$pagination->getPage(),'total'=>$pagination->totalCount,'data'=>$result];
    }

   
}
