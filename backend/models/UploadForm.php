<?php
namespace backend\models;

use Yii;
use yii\base\model;
use yii\web\UploadedFile;
/**
 * UploadForm is the model behind the upload form.
 *
 */
class UploadForm extends Model
{
   /**
    * @var UploadedFile file attribute
    */
   public $file;

    /**
     * @return array the validation rules.
     */
    public function  rules()
    {
        return
            [[['file'], 'file'],'extensions' => 'jpg,png','maxSize'=>1024000];
    }

    public function formName()
    {
        return '';
    }

}
