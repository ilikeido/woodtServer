<?php
namespace api\services;

use api\models\UserAccount;
use api\models\UserGroup;
use api\models\UserTag;
use \yii\db\Query;
use \yii\helpers\ArrayHelper;

class UserAccountService extends UserAccount{

    /*
     * 获取用户详情
     */
    public function getUserDetail($uid){
       $useraccount =  UserAccount::findOne($uid);
       $userResult = $useraccount->attributes;
       ArrayHelper::remove($userResult,'password');
       $query = (new Query())->select(['demand_tag.name AS name']) -> from('demand_tag')-> leftJoin('user_tag','user_tag.tagid = demand_tag.id')->where(['user_tag.uid'=>$uid]) ;
       $tags = $query->all();
       $userResult['tags'] = ArrayHelper::getColumn($tags,'name');
       return $userResult;
    }

   
}
