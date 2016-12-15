<?php
namespace api\services;

use api\models\UserAccount;
use api\models\UserGroup;
use api\models\UserTag;
use \yii\db\Query;
use \yii\helpers\ArrayHelper;

class CircleService extends UserAccount{

    /*
     * 获取用户详情
     */
    public static function getDetail($uid){
       $query = (new Query())->select(['username','nickname','email','mobile','uid','avatar','score','product','contact','parse_content']) -> from('user_account')->where(['uid'=>$uid]);
       $userinfo = $query->one();
        $tagsquery = (new Query())->select(['demand_tag.name AS name']) -> from('demand_tag')-> leftJoin('user_tag','user_tag.tagid = demand_tag.id')->where(['user_tag.uid'=>$uid]) ;
        $tags = $tagsquery->all();
        $userinfo['tags'] = ArrayHelper::getColumn($tags,'name');
        return $userinfo;
    }

    

   
}
