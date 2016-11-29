<?php

namespace api\controllers;

use Yii;
use yii\data\Pagination;
use api\models\DemandArea;
use api\models\DemandCategory;
use api\models\DemandGroup;
use api\models\DemandTag;
use api\models\UserAccount;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * TestController implements the CRUD actions for Test model.
 */
class UserController extends Controller
{

    public function actionRegister()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new UserAccount();
        if ($model->load(Yii::$app->request->post())) {
            if($model->validate() == true && $model->save()){
                $msg = array('errno'=>0, 'msg'=>'保存成功');
                echo json_encode($msg);
            }
            else{
                $msg = array('errno'=>2, 'data'=>$model->getErrors());
                echo json_encode($msg);
            }
        } else {
            $msg = array('errno'=>2, 'msg'=>'数据出错');
            echo json_encode($msg);
        }


        return null;
    }

    public function actionSendRegisterCode(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $mobile = Yii::$app->request->post('mobile');
        $count = UserAccount::find(['select'=>['id']])->where(['mobile'=>$mobile ])->count();
        $result = ['code'=>0,'msg'=>'验证码已发送手机，请查收','time'=>time()];
        if($count >0){
            $result = ['code'=>4,'msg'=>'此手机号已注册','time'=>time()];
        }
        return $result;
    }


}
