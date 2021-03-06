<?php
namespace api\controllers;

use Yii;
use yii\web\Controller;
use yii\web\BadRequestHttpException;
use yii\helpers\Url;
use yii\web\ForbiddenHttpException;
use common\utils\CommonFun;
use yii\helpers\StringHelper;
use yii\helpers\Inflector;
use yii\filters\auth\QueryParamAuth;
use yii\web\UploadedFile;
use api\models\UploadForm;

class UploadController extends Controller
{
    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
        $this->enableCsrfValidation = false;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
//        $behaviors['authenticator'] = [
//            'class' => QueryParamAuth::className(),
//        ];
        return $behaviors;
    }

    public function verbs()
    {
        return [];
    }

    /**
     * Checks the privilege of the current user.
     *
     * This method should be overridden to check whether the current user has the privilege
     * to run the specified action against the specified data model.
     * If the user does not have access, a [[ForbiddenHttpException]] should be thrown.
     *
     * @param string $action the ID of the action to be executed
     * @param object $model the model to be accessed. If null, it means no specific model is being accessed.
     * @param array $params additional parameters
     * @throws ForbiddenHttpException if the user does not have access
     */
    public function checkAccess($action, $model = null, $params = [])
    {
    }



    /**
     * Lists all UserTag models.
     * @return mixed
     */
    public function actionImage()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = new UploadForm();
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model,'file');
            //文件上传存放的目录
            $dir = Yii::$app->basePath.'/../static/'.date("Ymd");
            if (!is_dir($dir)){
                mkdir($dir);
            }
            if ($model->validate()) {
//文件名
                $fileName = date("HiiHsHis").$model->file->baseName . "." . $model->file->extension;
                $dir = $dir."/". $fileName;
                $model->file->saveAs($dir);
                $uploadSuccessPath = "/".date("Ymd").'/'.$fileName;
                return ['status'=>1,'path'=>$uploadSuccessPath,'info'=>'上传成功'];
            }
        }
        return ['status'=>0,'info'=>'上传失败'];
    }

//    public  function  mkdir($dir){
//        \yii\helpers\FileHelper::createDirectory($dir,0777);
//    }


}

?>