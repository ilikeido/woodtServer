<?php

namespace api\controllers;

use api\models\Dynamic;
use api\services\BaseService;
use api\services\DemandService;
use common\models\User;
use Yii;
use yii\data\Pagination;
use api\models\DemandArea;
use api\models\Demand;
use api\models\DemandCategory;
use api\models\DemandGroup;
use api\models\DemandTag;
use api\models\UserAccount;
use api\models\UserPhonemsg;
use yii\data\ActiveDataProvider;
use yii\db\Query;
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
        $nickname = Yii::$app->request->post('nickname');
        if ($mobile == null){
            return  ['code'=>3,'msg'=>'手机号不能为空','time'=>time()];
        }
        if($code == null){
            return  ['code'=>3,'msg'=>'验证码不能为空','time'=>time()];
        }

        $msgCount = (new Query())-> from('user_phonemsg')
            ->where(['mobile'=>$mobile])
            ->andWhere(['message_type' => 1])
            ->andWhere(['message' => $code])
            ->andWhere(['>','create_time', $this->getExpireTime()])
            ->count();
        if ($msgCount == 0){
            return  ['code'=>3,'msg'=>'验证码不正确','time'=>time()];
        }
        if ($nickname == null){
            $nickname = $username;
        }
        $model = new UserAccount();
        $model->username = $username;
        $model->password = md5($password);
        $model->mobile = $mobile;
        $model->email = $email;
        $model->nickname = $username;
        if($model->validate() == true && $model->save()){
            $token = md5(''.$model['uid'].time());
            $userInfo = $this->getUserDetail($model['uid']);
            $session = Yii::$app->session;
            if($session->isActive)
            {
            }else{
                $session -> open();
            }
            $session[$token] = $userInfo;
            $cookies = Yii::$app->response->cookies;
            $cookies->remove('home_user_auth_auto_login');
            $cookies->add(new \yii\web\Cookie([
                'name' => 'home_user_auth_auto_login',
                'value' => $token,
                'expire'=>time() + 86400 * 7
            ]));
            //todo  保存第三方登录的token
            return ['code'=>0,'msg'=>'保存成功','time'=>time(),'data'=>['uid'=>$model['uid'],'token'=>'test34343434']];
        }
        else{
            return ['code'=>2,'msg'=>$model->getErrors(),'time'=>time()];
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
            ->andWhere(['>','create_time', $this->getExpireTime()])
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
                    $session = Yii::$app->session;
                    if($session->isActive)
                    {
                    }else{
                        $session -> open();
                    }
                    $session[$token] = $userInfo;
                    $cookies = Yii::$app->response->cookies;
                    $cookies->remove('home_user_auth_auto_login');
                    $cookies->add(new \yii\web\Cookie([
                        'name' => 'home_user_auth_auto_login',
                        'value' => $token,
                        'expire'=>time() + 86400 * 7
                    ]));
                }
                return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>['uid'=>$userResult['uid'],'token'=>$token]];
            }else{
                return  ['code'=>2,'msg'=>'密码或用户名输入不正确','time'=>time()];
            }
        }
    }

    /*
     * 退出
     */
    public function actionLogout(){
        $userInfo = $this->getUserBySessionToken();
        $cookies = Yii::$app->request->cookies;
        $cookies->remove('home_user_auth_auto_login');
        $session = Yii::$app->session;
        $session->close();
        return  ['code'=>0,'msg'=>'','time'=>time()];
    }

    /*
     * 获取用户信息
     */
    public function actionGetinfo(){
        $userInfo = $this->getUserBySessionToken();
        if ($userInfo != null){
            return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>$userInfo];
        }
        return  ['code'=>1,'msg'=>'没有登录','time'=>time()];
    }

    /*
     * 判断是否登录
     */
    public function actionIslogin(){
        $cookies = Yii::$app->request->cookies;
        $token = $cookies['home_user_auth_auto_login'];
        $session = Yii::$app->session;
        if (!$session->isActive || $token == null || $session[$token] == null){
            return  ['code'=>1,'msg'=>'没有登录','time'=>time()];
        }else{
            $userInfo = $session[$token];
            return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>['uid'=>$userInfo['uid'],'nickname'=>$userInfo['nickname'],'avatar'=>BaseService::getImageBasePath() .$userInfo['avatar'],'mobile'=>$userInfo['mobile']]];
        }
    }

    /*
     * 获取用户详情
     */
    public  function actionDetail(){
        $uid = \yii::$app->request->post('uid');
        $userDetail = $this->getUserDetail($uid);
        if ($userDetail){
            return  ['code'=>0,'msg'=>'','time'=>time(),'data'=>$userDetail];
        }else{
            return  ['code'=>2,'msg'=>'没有找到用户','time'=>time()];
        }
    }


    /*
     * 获取用户详情
     */
    protected function getUserDetail($uid){
        $userDetail =  UserAccountService::getUserDetail($uid);
        if (!empty($userDetail['avatar'])){
            $userDetail['avatar'] = BaseService::getImageBasePath() . $userDetail['avatar'];
        }
        return $userDetail;
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

    /*
     * 添加供求信息
     */
    public function actionAdddemand(){
        $userInfo = $this->getUserBySessionToken();
        if ($userInfo != null){
            $model = new Demand();
            $group_id = Yii::$app->request->post('group_id');
            $category_id = Yii::$app->request->post('category_id');
            $content = Yii::$app->request->post('content');
            if (!empty($content)){
                $content = BaseService::ubb2html($content);
            }
            $tags = Yii::$app->request->post('tags');
            $unit = Yii::$app->request->post('unit');
            $title = Yii::$app->request->post('title');
            $area_id = Yii::$app->request->post('area');
            $price = Yii::$app->request->post('price');
            $address = Yii::$app->request->post('address');
            $buy_or_sale = Yii::$app->request->post('buy_or_sale');
            $number = Yii::$app->request->post('number');
            $parse = Yii::$app->request->post('parse');
            $group = DemandService::getGroupById($group_id);
            $category = DemandService::getCategoryById($category_id);
            $area = DemandService::getAreaById($area_id);
            $model->group_id = $group_id;
            $model->category_id = $category_id;
            $model->parse_content = $content;
            $model->tags = $tags;
            $model->title = $title;
            $model->unit = $unit;
            $model->uid = $userInfo['uid'];
            $model->area = $area_id;
            $model->area_title = $area->area;
            if (!empty($model->price)){
                $model->price = $price;
            }
            $model->address = $address;
            $model->buy_or_sale = $buy_or_sale;
            $model->number = $number;
            $model->category_name = $category['name'];
            $model->category_title = $category['title'];
            $model -> group_title = $group['name'];
            if ($model->validate() && $model->save()){
                return  ['code'=>0,'msg'=>'','time'=>time()];
            }else{
                return  ['code'=>2,'msg'=>$model->getErrors(),'time'=>time()];
            }
        }else{
            return  ['code'=>1,'msg'=>'没有登录','time'=>time()];
        }
    }

    /*
     * 添加供求信息
     */
    public function actionAdddynamic(){
        $userInfo = $this->getUserBySessionToken();
        if ($userInfo != null){
            $model = new Dynamic();
            $title = Yii::$app->request->post('title');
            $content = Yii::$app->request->post('content');
            $content = BaseService::ubb2html($content);
            $model->title = $title;
            $model->parse_content = $content;
            $model->uid = $userInfo['uid'];
            if ($model->validate() && $model->save()){
                return  ['code'=>0,'msg'=>'','time'=>time()];
            }else{
                return  ['code'=>2,'msg'=>$model->getErrors(),'time'=>time()];
            }
        }else{
            return  ['code'=>1,'msg'=>'没有登录','time'=>time()];
        }
    }

    /*
     * 设置用户信息
     */
    public function actionSetinfo(){
        $userInfo = $this->getUserBySessionToken();
        if ($userInfo != null) {
            $model = UserAccountService::findOne($userInfo['uid']);
            $avatar = Yii::$app->request->post('avatar');
            if (empty($avatar) == false){
                $userInfo['avatar'] = $avatar;
                $model['avatar'] = $avatar;
            }
            $nickname = Yii::$app->request->post('nickname');
            if ($nickname != null){
                $userInfo['nickname'] = $nickname;
                $model['nickname'] = $nickname;
            }
            $contact = Yii::$app->request->post('contact');
            if ($contact != null){
                $userInfo['contact'] = $contact;
                $model['contact'] = $contact;
            }
            $email = Yii::$app->request->post('email');
            if ($email != null){
                $userInfo['email'] = $email;
                $model['email'] = $email;
            }
            $product = Yii::$app->request->post('product');
            if ($product != null){
                $userInfo['product'] = $product;
                $model['product'] = $product;
            }
            $content = Yii::$app->request->post('content');
            if ($content != null){
                $userInfo['content'] = $content;
                $model['content'] = $content;
            }
            $model->save();
            $cookies = Yii::$app->request->cookies;
            $token = $cookies->getValue('home_user_auth_auto_login');
            $session = Yii::$app->session;
            $session[$token] = $userInfo;
            return  ['code'=>0,'msg'=>'修改成功','time'=>time()];
        }else{
            return  ['code'=>1,'msg'=>'没有登录','time'=>time()];
        }
    }

    private function validatePassword($password){

    }

}
