<?php
namespace api\services;

use api\models\UserAccount;
use api\models\UserGroup;
use api\models\UserTag;
use api\models\UserAttention;
use \yii\db\Query;
use \yii\helpers\ArrayHelper;

class UserAttentionService extends UserAccount{

    /**
     * 判断是否关注
     */
    public function attentionIsExits($uid,$tid){
        $count = UserAttention::find()->where(['uid'=>$uid])->andWhere(['tid'=>$tid])->count();
        if ($count >0)
            return true;
        return false;
    }

    /**
     * 增加关注
     */
    public function addAttention($uid,$tid){
        if ($this->attentionIsExits($uid,$tid)){
            return true;
        }
        $model = new UserAttention();
        $model->uid = $uid;
        $model->tid = $tid;
        $model->save();
        return true;
    }


    /**
     * 删除关注
     */
    public function delAttention($uid,$tid){
        UserAttention::deleteAll(['uid'=>$uid,'tid'=>$tid]);
        return true;
    }
   
}
