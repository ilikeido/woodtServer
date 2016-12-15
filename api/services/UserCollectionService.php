<?php
namespace api\services;

use api\models\UserAccount;
use api\models\UserCollection;
use \yii\db\Query;
use \yii\helpers\ArrayHelper;

class UserCollectionService extends UserCollection{

    /**
     * 判断是否收藏
     */
    public static function collectionIsExits($uid,$tid,$channel){
        $query = UserCollection::find()->where(['uid'=>$uid])->andWhere(['tid'=>$tid]);
        if ($channel){
            $query->andWhere(['channel'=>$channel]);
        }
        $count = $query->count();
        if ($count >0)
            return true;
        return false;
    }

    /**
     * 增加收藏
     */
    public static function addCollection($uid,$tid,$channel,$title){
        if (collectionIsExits($uid,$tid,$channel)){
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
     * 删除收藏
     */
    public static function delCollection($uid,$tid,$channel){
        UserCollection::deleteAll(['uid'=>$uid,'tid'=>$tid,'channel'=>$channel]);
        return true;
    }
   
}
