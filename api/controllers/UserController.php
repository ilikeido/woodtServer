<?php

namespace api\controllers;

use common\models\User;
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
use api\services\UserAccountService;
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
        $msgCount = UserPhonemsg::find()
            ->where(['mobile'=>$mobile])
            ->andWhere(['message_type' => 1])
            ->andWhere(['message' => $code])
            ->andWhere('<','create_time', date('Y-m-d H:i:s',time()-60*10))
            ->count();
        if ($msgCount == 0){
            return  ['code'=>3,'msg'=>'验证码不正确','time'=>time()];
        }
        $model = new UserAccount();
        $model->username = $username;
        $model->password = md5($password);
        $model->mobile = $mobile;
        $model->email = $email;
        if($model->validate() == true && $model->save()){
            $msg = array('code'=>0, 'msg'=>'保存成功');
            return $msg;
        }
        else{
            $msg = array('errno'=>2, 'data'=>$model->getErrors());
            return $msg;
        }
    }

    /*
     * 发送注册验证码
     */
    public function  actionSendregistercode(){
        $mobile = Yii::$app->request->post('mobile');
        $count = (new \yii\db\Query())
            ->from('user_account')
            ->where('mobile=:mobile', [':mobile' => $mobile])
            ->count();
        if ($count > 0){
            return  ['code'=>2,'msg'=>'该手机号已被注册','time'=>time()];
        }
        $randCode = strval($this->getRandCode(4));
        $msgResult = UserPhonemsg::find()
            ->where(['mobile'=>$mobile])
            ->andWhere(['message_type' => 1])
            ->andWhere(['>','create_time', $this->getＥxpireTime()])
            ->orderBy('id desc')
            ->one();
        if ($msgResult != null){
            $randCode = $msgResult->message;
        }
        $msg = new UserPhonemsg;
        $msg->mobile = $mobile;
        $msg->message_type = 1;
        $msg->message = $randCode;
        $msg->save();
        $this->sendMsg('您的验证码是'.$randCode.'。如非本人操作，请忽略本短信。');
        return  ['code'=>0,'msg'=>'验证码已发送','time'=>time()];

    }

    /**
     * 发送忘记密码
     */
    public function actionSendgetpwdcode(){
        $mobile = Yii::$app->request->post('mobile');
        $count = (new \yii\db\Query())
            ->from('user_account')
            ->where('mobile=:mobile', [':mobile' => $mobile])
            ->count();
        if ($count == 0){
            return  ['code'=>2,'msg'=>'该手机号未注册','time'=>time()];
        }
        $msgResult = UserPhonemsg::find()
            ->where(['mobile'=>$mobile])
            ->andWhere(['message_type' => 2])
            ->andWhere(['>','create_time', $this->getExpireTime()])
            ->orderBy('id desc')
            ->one();
        $randCode = strval($this->getRandCode(4));
        if ($msgResult != null){
            $randCode = $msgResult->message;
        }
        $msg = new UserPhonemsg;
        $msg->mobile = $mobile;
        $msg->message_type = 2;
        $msg->message = $randCode;
        $msg->save();
        $this->sendMsg('正在找回密码，您的验证码是'.$randCode.'。如非本人操作，请忽略本短信。');
        return  ['code'=>0,'msg'=>'验证码已发送','time'=>time()];
    }

    /*
     * 验证码校验(忘记密码)
     */
    public function actionCheckcode(){
        $mobile = Yii::$app->request->post('mobile');
        $code = Yii::$app->request->post('code');
        $msgCount = UserPhonemsg::find()
            ->where(['mobile'=>$mobile])
            ->andWhere(['message_type' => 2])
            ->andWhere(['message' => $code])
            ->andWhere(['>','create_time', $this->getExpireTime()])
            ->count();
        if ($msgCount == 0){
            return  ['code'=>3,'msg'=>'验证码错误或已过期','time'=>time()];
        }
        return ['code'=>0,'msg'=>'','time'=>time(),'data'=>true];
    }

    /**
     * 密码重置
     */
    public function actionSetpwdbymobile(){
        $password = Yii::$app->request->post('password');
        $mobile = Yii::$app->request->post('mobile');
        $code = Yii::$app->request->post('code');
        $msgCount = UserPhonemsg::find()
            ->where(['mobile'=>$mobile])
            ->andWhere(['message_type' => 2])
            ->andWhere(['message' => $code])
            ->count();
        if ($msgCount == 0){
            return  ['code'=>3,'msg'=>'该操作无效','time'=>time()];
        }
        $user = UserAccount::find()->where(['mobile'=>$mobile])->one();
        $user['password'] = md5($password);
        $user->save();
        return ['code'=>0,'msg'=>'55759','time'=>time(),'data'=>true];
    }
    /*
     * 获取过期时间
     */
    protected function getExpireTime(){
        return date('Y-m-d H:i:s',time()-10*60);
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
    public function actionSubmitlogin(){
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');
        $autologin = Yii::$app->request->post('autologin');
        if ($username == null ||  $password == null){
            return  ['code'=>1,'msg'=>'用户名、密码不能为空','time'=>time()];
        }
        $userResult = UserAccount::find()
            ->select(['uid','password'])
            ->where(['username'=>$username])
            ->orWhere(['mobile'=>$username])
            ->one();
        if($userResult == null){
            return  ['code'=>2,'msg'=>'未找到用户','time'=>time()];
        }else{
            if ($userResult['password'] === md5($password)){
                if ($autologin === '1'){
                    $token = md5(''.$userResult['uid'].time());
                    $userInfo = $this->getUserDetail($userResult['uid']);
                    $_SESSION[$token] = $userInfo;
                    $_COOKIE['home_user_auth_auto_login'] = $token;
                }
                return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>['uid'=>$userResult['uid'],'token'=>$token]];
            }else{
                return  ['code'=>2,'msg'=>'密码或用户名输入不正确','time'=>time()];
            }
        }
    }

    /*
     * 获取用户信息
     */
    public function actionGetinfo(){
        $token = $_COOKIE['home_user_auth_auto_login'];
        if (!$_SESSION->isActive || $token == null || $_SESSION[$token] == null){
            return  ['code'=>1,'msg'=>'没有登录','time'=>time()];
        }else{
            $userInfo = $_SESSION[$token];
            return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>$userInfo];
        }
    }

    /*
     * 获取用户详情
     */
    protected function getUserDetail($uid){
        $userService =  new UserAccountService();
        $userDetail =  $userService->getUserDetail($uid);
        return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>$userDetail];
    }

    /**
     * 获取session
     */
    public function actionRefresh(){
        //1.调用session组件
        $session = \Yii::$app -> session;
        //2.判断session是否开启
        if($session->isActive)
        {

        }else{
            //3.开启session
            $session -> open();
        }
        return  ['code'=>2,'msg'=>'','time'=>time(),'data'=>0];
    }

    private function validatePassword($password){

    }

}
