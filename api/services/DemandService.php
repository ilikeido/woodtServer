<?php
namespace api\services;

use api\models\Demand;
use api\models\DemandArea;
use api\models\DemandCategory;
use api\models\DemandGroup;
use api\models\UserAccount;
use api\models\UserGroup;
use api\models\UserTag;
use \yii\db\Query;
use \yii\helpers\ArrayHelper;
use \yii\data\Pagination;

class DemandService extends Demand {

    public static function getCatorysAndTag(){
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
            $_category['groups'] = $tempGroupArray;
        }
        return $categories;
    }


    /*
     * 获取标签列表
     */
    public static function getTags($categoryid,$groupid){
        $tagQuery = (new Query())->select(['name'])->from('demand_tag')->where(['group_id'=>$groupid])->andWhere(['flag'=>1])->orderBy('id');
        $tags = $tagQuery->all();
        return $tags;
    }

    /*
     * 获取类型列表
     */
    public static function getAllcatorys(){
        $categroyQuery = (new Query())->select(['id','name','title'])->from('demand_category')->where(['flag'=>1])->orderBy('sort,id');
        $categories = $categroyQuery->all();
        $groupQuery = (new Query())->select(['id','category_id','name'])->from('demand_group')->where(['flag'=>1])->orderBy('id');
        $groups = $groupQuery->all();
        foreach ($categories as &$_category){
            $tempGroupArray = array();
            foreach ($groups as $group){
                if ($_category['id'] === $group['category_id']){
                    ArrayHelper::remove($group,'category_id');
                    array_push($tempGroupArray,[$group['id'],$group['name']]);
                }
            }
            $_category['groups'] = $tempGroupArray;
        }
        return $categories;
    }



    /*
     * 获取供求详情
     */
    public static function getDetail($id){
        $query = (new Query())->from('demand')->where(['id'=>$id]);
        $demand = $query->one();
        if ($demand != null){
            $demand['create_time_format'] = BaseService::format_date(strftime($demand['create_time']));
            $userQuery = (new Query())->from('user_account')->select(['uid','nickname','avatar','mobile','contact','level_number'])->where(['uid'=>$demand['uid']]);
            $user = $userQuery->one();
            $demand['user'] = $user;
        }
       return $demand;
    }

    public static function getGroupById($id){
        return DemandGroup::findOne($id);
    }

    public static function getCategoryById($id){
        return DemandCategory::findOne($id);
    }

    public static function  getAreaById($id){
        return DemandArea::findOne($id);
    }

    public static function  getDemandById($id){
        return Demand::findOne($id);
    }

    /**
     * @param $offset 偏移
     * @param $limit  数量
     * @param string $order  排序
     * @return array  返回供求列表
     */
    public static function getDemandsWithUserList($offset,$limit,$order='id desc'){
        $query = (new Query())->from('demand')->select(['id','uid','title','view','create_time','buy_or_sale'])->orderBy($order)->where(['flag' => 1]);
        $query = $query->offset($offset)->limit($limit);
        $result = $query->all();
        $uids = array();
        foreach ($result as &$item){
            $createtime = $item['create_time'];
            $createtimeFormat = BaseService::format_date(strftime($createtime));
            $item['create_time_format'] = $createtimeFormat;
            array_push($uids,$item['uid']);
        }
        $userQuery = (new Query())->from('user_account')->select(['uid','nickname','avatar','level_number'])->where(['in','uid',$uids]);
        $users = $userQuery->all();
        foreach ($result as &$item){
            foreach ($users as $user){
                if ($user['uid'] === $item['uid']){
                    $item['user'] = $user;
                    break;
                }
            }
        }
        return $result;
    }

    /*
     * 获取供求列表
     */
    public static function getPage($root,$p=1,$uid,$catory='',$group='',$tag='',$area='',$order='id desc'){
        if($order == null){
            $order = 'id desc';
        }
        $query = (new Query())->from('demand')->select(['id','uid','title','view','create_time','buy_or_sale'])->orderBy($order)->where(['flag' => 1]);
        if ($root === 'sale'){
            $query = $query->andWhere(['buy_or_sale'=>2]);
        }
        if($root === 'buy'){
            $query = $query->andWhere(['buy_or_sale'=>1]);
        }
        if(!empty($catory) && !($catory === 'demand')){
            $query = $query->andWhere(['category_id'=>$catory]);
        }
        if(!empty($uid)){
            $query = $query->andWhere(['uid'=>$uid]);
        }
        if(!empty($group)){
            $query = $query->andWhere(['group_id'=>$group]);
        }
        if(!empty($tag)){
            $query = $query->andWhere(['like','title',$tag]);
        }
        if(!empty($area)){
            $query = $query->andWhere(['area'=>$area]);
        }
        $pagination = new Pagination([
                'totalCount' =>$query->count(),
                'pageSize' => '30',]
        );
        $pagination->page = $p-1;
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
            $item['create_time_format'] = $createtimeFormat;
            array_push($uids,$item['uid']);
        }
        $userQuery = (new Query())->from('user_account')->select(['uid','nickname','level_number'])->where(['in','uid',$uids]);
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
