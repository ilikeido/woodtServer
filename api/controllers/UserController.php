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
use api\controllers\BaseController;
/**
 * TestController implements the CRUD actions for Test model.
 */
class UserController extends BaseController
{

    public function actionRegister()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new UserAccount();
        if ($model->load(Yii::$app->request->post())) {
            if($model->validate() == true && $model->save()){
                $msg = array('code'=>0, 'msg'=>'保存成功');
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

    public function actionLogin(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');
        $autologin = Yii::$app->request->post('autologin');
        if ($username == null ||  $password == null){
            return  ['code'=>1,'msg'=>'用户名、密码不能为空','time'=>time()];
        }
        $userResult = (new \yii\db\Query())
            ->from('user_account')
            ->where(['or','username=:username','mobile=:username'])
            ->addParams([":username"=>$username])
            ->one();
        if($userResult == null){
            return  ['code'=>2,'msg'=>'未找到用户','time'=>time()];
        }else{
            if ($userResult['password'] === md5($password)){
                if ($autologin === '1'){
                    $auth_login = md5(''.time());
                    $_SESSION[$auth_login] = $userResult;
                    $_COOKIE['home_user_auth_auto_login'] = $auth_login;
                }
                return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>$userResult];
            }else{
                return  ['code'=>2,'msg'=>'密码或用户名输入不正确','time'=>time()];
            }
        }
    }

    private function validatePassword($password){

    }

}
