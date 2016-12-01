<?php

namespace api\controllers;

use Yii;
use yii\data\Pagination;
use api\models\DemandArea;
use api\models\DemandCategory;
use api\models\DemandGroup;
use api\models\DemandTag;
use api\models\UserAccount;
use api\models\UserPhonemsg;
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
    /*
     * 普通用户注册
     */
    public function actionDoregister()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');
        $mobile = Yii::$app->request->post('mobile');
        $code = Yii::$app->request->post('code');
        $email = Yii::$app->request->post('email');
        if ($mobile == null){
            return  ['code'=>3,'msg'=>'手机号不能为空','time'=>time()];
        }
        if($code == null){
            return  ['code'=>3,'msg'=>'验证码不能为空','time'=>time()];
        }
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

    /*
     * 发送注册验证码
     */
    public function  actionSendregistercode(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $mobile = Yii::$app->request->post('mobile');
        $count = (new \yii\db\Query())
            ->from('user_account')
            ->where('mobile=:mobile', [':mobile' => $mobile])
            ->count();
        if ($count > 0){
            return  ['code'=>2,'msg'=>'该手机号已被注册','time'=>time()];
        }
        $msgResult = UserPhonemsg::find()
            ->where(['mobile'=>$mobile])
            ->andWhere(['message_type' => 1])
            ->orderBy('id')
            ->one();
//        $msgResult = (new \yii\db\Query())
//            ->from('user_phonemsg')
//            ->where(['and','mobile=:mobile','message_type=1'])
//            ->orderBy('id DESC')
//            ->addParams([":mobile"=>$mobile])
//            ->one();
        if ($msgResult != null){
            $createTime = $msgResult['create_time'];
            $randCode = strval($this->getRandCode(4));
            if ($createTime !=null) {
                $second=floor((time() - strtotime($createTime))%86400%60);
                $randCode = strval($this->getRandCode(4));
                if ($second < 10){//10分钟
                    $randCode = $msgResult->message;
                    $timeString = date('Y-m-d H:i:s',time());
                    $msgResult['create_time'] = $timeString;
                    $this->sendMsg($randCode);
                    $msgResult->save();
                    return  ['code'=>0,'msg'=>'验证码已发送','time'=>time()];
                }else{
                    $msgResult['flag'] = 0;
                    $msgResult->save();
                }
            }
        }
        $randCode = strval($this->getRandCode(4));
        $msg = new UserPhonemsg;
        $msg->mobile = $mobile;
        $msg->message_type = 1;
        $msg->message = $randCode;
        $msg->save();
        $this->sendMsg($randCode);
        return  ['code'=>0,'msg'=>'验证码已发送','time'=>time()];

    }

    /**
     * 发送消息
     * @param string $msg   消息
     * @return boolean   发送验证码成功或失败
     */
    protected  function sendMsg($msg = ''){
        $mymssgae = $msg;
        //TODO

        return true;
    }

    /*
     * 生成验证码
     */
    private  function getRandCode($length = 4){
        $min = pow(10 , ($length - 1));
        $max = pow(10, $length) - 1;
        return mt_rand($min, $max);
    }

    /*
     * 登录
     */
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
