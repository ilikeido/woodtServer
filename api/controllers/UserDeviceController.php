<?php

namespace api\controllers;

use Yii;
use api\models\UserDevice;


/**
 * TestController implements the CRUD actions for Test model.
 */
class UserDeviceController extends BaseController
{
    /*
     * 保存登录设备记录
     */
    public function actionSave()
    {

        $start = Yii::$app->request->post('start');
        $device_id = Yii::$app->request->post('device_id');
        $device_name = Yii::$app->request->post('device_name');
        $device_model = Yii::$app->request->post('device_model');
        $connection_type = Yii::$app->request->post('connection_type');
        $os_type = Yii::$app->request->post('os_type');
        $os_version = Yii::$app->request->post('os_version');
        $app_version = Yii::$app->request->post('app_version');
        $tencent_push_id = Yii::$app->request->post('tencent_push_id');
        $tencent_push_token = Yii::$app->request->post('tencent_push_token');
        $model = UserDevice::find()->where(['device_id'=>$device_id])->one();
        if ($model == null){
            $model = new UserDevice();
        }
        $model['device_id'] = $device_id;
        $model['device_name'] = $device_name;
        $model['connection_type'] = $connection_type;
        $model['device_model'] = $device_model;
        $model['os_type'] = $os_type;
        $model['app_version'] = $app_version;
        $model['tencent_push_id'] = $tencent_push_id;
        $model['tencent_push_token'] = $tencent_push_token;
        $ip = Yii::$app->request->userIP;
        $model['ip'] = $ip;
        $token = $_COOKIE['home_user_auth_auto_login'];
        $session = Yii::$app->session;
        if (!$session->isActive || $token == null || $session[$token] == null){

        }else{
            $user = $_SESSION[$token];
            $model['uid'] = $user['uid'];
        }
        $model->save();
        return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>'保存成功'];
    }

}
