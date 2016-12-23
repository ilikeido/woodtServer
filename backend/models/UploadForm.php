<?php
namespace backend\models;

use Yii;
use yii\base\Model;
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
        return [
            [['file'], 'file'],
        ];
    }

    public function formName()
    {
        return '';
    }

}
