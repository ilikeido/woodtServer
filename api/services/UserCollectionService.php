<?php
namespace api\services;

use api\models\UserAccount;
use api\models\UserCollection;
use \yii\db\Query;
use \yii\helpers\ArrayHelper;

class UserCollectionService extends UserAccount{

    /**
     * 判断是否关注
     */
    public function collectionIsExits($uid,$tid){
        $count = UserCollection::find()->where(['uid'=>$uid])->andWhere(['tid'=>$tid])->count();
        if ($count >0)
            return true;
        return false;
    }

    /**
     * 增加关注
     */
    public function addCollection($uid,$tid,$channel,$title){
        if ($this->collectionIsExits($uid,$tid)){
            return true;
        }
        $model = new UserCollection();
        $model->uid = $uid;
        $model->tid = $tid;
        $model->channel = $channel;
        $model->title = $title;
        $model->save();
        return true;
    }


    /**
     * 删除关注
     */
    public function delAttention($uid,$tid){
        UserCollection::deleteAll(['uid'=>$uid,'tid'=>$tid]);
        return true;
    }
   
}
