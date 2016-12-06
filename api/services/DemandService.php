<?php
namespace api\services;

use api\models\Demand;
use api\models\UserAccount;
use api\models\UserGroup;
use api\models\UserTag;
use \yii\db\Query;
use \yii\helpers\ArrayHelper;
use \yii\data\Pagination;

class DemandService extends Demand {

    public function getCatorysAndTag(){
        $categroyQuery = (new Query())->select(['id','name','title'])->from('demand_category')->where(['flag'=>1])->orderBy('sort,id');
        $categories = $categroyQuery->all();
        $groupQuery = (new Query())->select(['id','category_id','name AS title'])->from('demand_group')->where(['flag'=>1])->orderBy('id');
        $groups = $groupQuery->all();
        $tagQuery = (new Query())->select(['id','group_id','name'])->from('demand_tag')->where(['flag'=>1])->orderBy('group_id,id');
        $tags = $tagQuery->all();
        foreach ($groups as &$_group){
            $tempTagArray = array();
            foreach ($tags as $tag){
                if ($_group['id'] === $tag['group_id']){
                    array_push($tempTagArray,$tag);
                }
            }
            $_group['tags'] = ArrayHelper::getColumn($tempTagArray,'name');
        }
        foreach ($categories as &$_category){
            $tempGroupArray = array();
            foreach ($groups as $group){
                if ($_category['id'] === $group['category_id']){
                    ArrayHelper::remove($group,'category_id');
                    array_push($tempGroupArray,$group);
                }
            }
            $_category['group'] = $tempGroupArray;
        }
        return $categories;
    }


    /*
     * 获取标签列表
     */
    public function getTags($categoryid,$groupid){
        $tagQuery = (new Query())->select(['name'])->from('demand_tag')->where(['group_id'=>$groupid])->andWhere(['flag'=>1])->orderBy('id');
        $tags = $tagQuery->all();
        return $tags;
    }

    /*
     * 获取类型列表
     */
    public function getAllcatorys(){
        $categroyQuery = (new Query())->select(['id','name','title'])->from('demand_category')->where(['flag'=>1])->orderBy('sort,id');
        $categories = $categroyQuery->all();
        $groupQuery = (new Query())->select(['id','category_id','name'])->from('demand_group')->where(['flag'=>1])->orderBy('id');
        $groups = $groupQuery->all();
        foreach ($categories as &$_category){
            $tempGroupArray = array();
            foreach ($groups as $group){
                if ($_category['id'] === $group['category_id']){
                    array_push($tempGroupArray,$group);
                }
            }
            $_category['group'] = ArrayHelper::map($tempGroupArray,'id','name');
        }
        return $categories;
    }

    /*
     * 获取供求详情
     */
    public function getDetail($id){
        $query = (new Query())->from('demand')->where(['id'=>$id]);
        $demand = $query->one();
        if ($demand != null){
            $userQuery = (new Query())->from('user_account')->select(['uid','nickname','avatar','mobile','contact','level_number'])->where(['uid'=>$demand['uid']]);
            $user = $userQuery->one();
            $demand['user'] = $user;
        }
       return $demand;
    }

    /*
     * 获取供求列表
     */
    public function getPage($root,$p=1,$catory='',$group='',$tag='',$area='',$order='pos'){
        $query = (new Query())->from('demand')->select(['id','uid','title','view','create_time','buy_or_sale'])->where(['flag' => 1]);
        if ($root === 'sale'){
            $query = $query->andWhere(['buy'=>2]);
        }
        if($root === 'buy'){
            $query = $query->andWhere(['buy'=>1]);
        }
        if(!empty($catory)){
            $query = $query->andWhere(['category_name'=>$catory]);
        }
        if(!empty($group)){
            $query = $query->andWhere(['group_id'=>$group]);
        }
        if(!empty($tag)){
            $query = $query->andWhere(['tag'=>$tag]);
        }
        if(!empty($area)){
            $query = $query->andWhere(['area'=>$area]);
        }
        $count = $query->count();
        $pagination = new Pagination(['totalCount' =>$count, 'pageSize' => 30,'page'=>$p]);
        if($order === 'time'){
            $query = $query->orderBy('create_time desc');
        }else if($order === 'price_desc'){
            $query = $query->orderBy('price desc,id desc');
        }else if($order === 'price_asc'){
            $query = $query->orderBy('price asc,id desc');
        }else if($order === 'pos'){
            $query = $query->orderBy('sort asc,id desc');
        }
        $query = $query->offset($pagination->offset)->limit($pagination->limit);
        $result = $query->all();
        $uids = array();
        foreach ($result as &$item){
            $createtime = $item['create_time'];
            $createtimeFormat = BaseService::format_date(strftime($createtime));
            $createtime['create_time_format'] = $createtimeFormat;
            array_push($uids,$item['uid']);
        }
        $userQuery = (new Query())->from('user_account')->select(['uid','nickname','level_number'])->where(['in','id',$uids]);
        $users = $userQuery->all();
        foreach ($result as &$item){
           foreach ($users as $user){
               if ($user['uid'] === $item['uid']){
                   $item['user'] = $user;
                   break;
               }
           }
        }
        return ['pagesize'=>$pagination->getPageSize(),'p'=>$pagination->getPage(),'total'=>$pagination->totalCount,'data'=>$result];
    }

   
}
