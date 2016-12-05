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

class BaseController extends Controller
{
    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = true;
        $this->enableCsrfValidation = false;
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
//        $behaviors['authenticator'] = [
//            'class' => QueryParamAuth::className(),
//        ];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
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


}

?>