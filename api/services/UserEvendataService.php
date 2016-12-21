<?php
namespace api\services;

use api\models\UserEvendata;
use yii\helpers\ArrayHelper;
use \yii\db\Query;
use \yii\data\Pagination;

class UserEvendataService extends UserEvendata{

    /*
     * 获取动态列表
     */
    public static function getPage($p=1,$tag=''){

        $query = (new Query())->from('user_evendata')->select(['uid','nickname','avatar','product','contact','last_update_time','level_number','dynamic_id','demand_count', 'dynamic_count']);
        if (!empty($tag)){
            $query -> where(['or', ['like','product',$tag],['like','nickname',$tag]]);
        }
        $pagination = new Pagination([
                'totalCount' =>$query->count(),
                'pageSize' => '30',
                'pageParam'=>'p',
                'pageSizeParam'=>'per-page']
        );
        $pagination->page = $p -1;
        $query = $query->offset($pagination->offset)->limit($pagination->limit)->orderBy('id desc');
        $result = $query->all();
        if ($result != null){
            $ids = array();
            foreach ($result as &$item){
                $document_count = $item['demand_count'] + $item['dynamic_count'];
                array_push($ids,$item['dynamic_id']);
            }
            $dynamicQuery = (new Query())->from('dynamic')->select(['id','uid','title','create_time'])->where(['in','id',$ids]);
            $dynamics = $dynamicQuery->all();
            foreach ($result as &$item){
                $item['dynamic'] = [];
                foreach ($dynamics as $dynamic){
                    if ($dynamic['id'] === $item['dynamic_id']){
                        $item['dynamic'] = $dynamic;
                        break;
                    }
                }
            }
            ArrayHelper::remove($result,'demand_count');
            ArrayHelper::remove($result,'dynamic_count');
            ArrayHelper::remove($result,'dynamic_id');
        }
        return ['pagesize'=>$pagination->getPageSize(),'p'=>$p,'total'=>$pagination->totalCount,'data'=>$result];
    }


}
