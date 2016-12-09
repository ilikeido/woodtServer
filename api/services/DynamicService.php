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

class DynamicService extends Demand {
    /*
     * 获取供求列表
     */
    public function getPage($uid,$p=1,$keyword=''){
        $query = (new Query())->from('dynamic')->select(['id','uid','title','parse_content','create_time'])->where(['flag' => 1]);
        if (!empty($keyword)){
            $query -> andWhere(['like','title',$keyword]);
        }
        if (!empty($uid)){
            $query -> andWhere(['uid'=>$uid]);
        }
        $pagination = new Pagination([
                'totalCount' =>$query->count(),
                'pageSize' => '30',
                'pageParam'=>'page',
                'pageSizeParam'=>'per-page']
        );
        $query = $query->offset($pagination->offset)->limit($pagination->limit);
        $result = $query->all();
        if ($result != null){
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
        }
        return ['pagesize'=>$pagination->getPageSize(),'p'=>$pagination->getPage(),'total'=>$pagination->totalCount,'data'=>$result];
    }

   
}
