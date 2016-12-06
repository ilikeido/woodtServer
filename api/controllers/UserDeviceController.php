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
        $model = new UserDevice();
        if ($model->load(Yii::$app->request->post())) {
            $token = $_COOKIE['home_user_auth_auto_login'];
            if (!$_SESSION->isActive || $token == null || $_SESSION[$token] == null){

            }else{
                $user = $_SESSION[$token];
                $model['uid'] = $user['uid'];
            }
            $model->save();
        }
        return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>'保存成功'];
    }

}
