<?php
namespace api\services;

use api\models\Demand;
use api\models\DemandArea;
use api\models\DemandCategory;
use api\models\DemandGroup;
use api\models\UserAccount;
use api\models\UserGroup;
use api\models\Dynamic;
use \yii\db\Query;
use \yii\helpers\ArrayHelper;
use \yii\data\Pagination;

class DynamicService extends Dynamic {
    /*
     * 获取供求列表
     */
    public static function getPage($type,$p=1,$keyword='',$uid = ''){
        $query = (new Query())->from('dynamic')->select(['dynamic.id as id','dynamic.uid as uid','title','create_time'])->where(['dynamic.flag' => 1]);
        if (!empty($keyword)){
            $query -> andWhere(['like','title',$keyword]);
        }
        if (!empty($type) && $type !== 'all'){
            if ($type === 'auth'){
                $query->leftJoin('user_account', 'user_account.uid = dynamic.uid');
                $query->andWhere(["user_account.is_auth"=>1]);
                $query->andWhere(["user_account.flag"=>1]);
            }else if($type === 'attention' && !empty($uid)){
                $query->leftJoin('user_attention', 'user_attention.tid = dynamic.uid');
                $query->andWhere(["user_attention.uid"=>$uid]);
            }
        }
        $pagination = new Pagination([
                'totalCount' =>$query->count(),
                'pageSize' => '30',
                'pageParam'=>'page',
                'pageSizeParam'=>'per-page']
        );
        $pagination->page = $p -1;
        $query = $query->offset($pagination->offset)->limit($pagination->limit)->orderBy('id desc');
        $result = $query->all();
        if ($result != null){
            $uids = array();
            foreach ($result as &$item){
                $createtime = $item['create_time'];
                $createtimeFormat = BaseService::format_date(strftime($createtime));
                $item['create_time_format'] = $createtimeFormat;
                array_push($uids,$item['uid']);
            }
            $userQuery = (new Query())->from('user_account')->select(['uid','nickname','level_number','avatar'])->where(['in','uid',$uids]);
            $users = $userQuery->all();
            foreach ($result as &$item){
                foreach ($users as $user){
                    if ($user['uid'] === $item['uid']){
                        $user['avatar'] = BaseService::getImageBasePath() . $user['avatar'];
                        $item['user'] = $user;
                        break;
                    }
                }
            }
        }
        return ['pagesize'=>$pagination->getPageSize(),'p'=>$p,'total'=>$pagination->totalCount,'list'=>$result];
    }

    /**
     * @param $offset 偏移
     * @param $limit  数量
     * @param string $order  排序
     * @return array  返回供求列表
     */
    public static function getDynmicsWithUserList($offset,$limit,$order='id desc'){
        $query = (new Query())->from('dynamic')->select(['id','title','create_time','uid'])->orderBy($order)->where(['flag' => 1]);
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
                    $user['avatar'] = BaseService::getImageBasePath() .$user['avatar'];
                    $item['user'] = $user;
                    break;
                }
            }
        }
        return $result;
    }

    /*
     * 获取供求详情
     */
    public static function getDetail($id){
        $query = (new Query())->from('dynamic')->where(['id'=>$id]);
        $dynamic = $query->one();
        if ($dynamic != null){
            $dynamic['create_time_format'] = BaseService::format_date(strftime($dynamic['create_time']));
            $userQuery = (new Query())->from('user_account')->select(['uid','nickname','avatar','mobile','contact','level_number'])->where(['uid'=>$dynamic['uid']]);
            $user = $userQuery->one();
            $user['avatar'] = BaseService::getImageBasePath() . $user['avatar'];
            $dynamic['user'] = $user;
            $dynamic['nickname'] = $user['nickname'];
            $dynamic['avatar'] = $user['avatar'];
        }
        return $dynamic;
    }
   
}
