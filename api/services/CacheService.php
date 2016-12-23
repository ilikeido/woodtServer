<?php
/**
 * Created by PhpStorm.
 * User: ilikeido
 * Date: 16/12/23
 * Time: 下午7:20
 */

namespace api\services;

class CacheService  {

    const  CACHEKEY_GET_CATORY_AND_TAG = 'getCatorysAndTag';

    const  CACHEKEY_GET_ALL_CATORYS = 'getallcategory';

    public static function getDependencyValue($key){
        $dependencyKey = $key . '_update_time';
        $cache = Yii::$app->cache;
        $value = $cache->get($dependencyKey);
        if ($value == null){
            $value = time();
            $cache->add($dependencyKey,$value,0);
        }
        return $value;
    }

    public static function restDependencyValue($key){
        $dependencyKey = $key . '_update_time';
        $cache = Yii::$app->cache;
        $value = $cache->get($dependencyKey);
        $value = time();
        $cache->add($dependencyKey,$value,0);
    }

}