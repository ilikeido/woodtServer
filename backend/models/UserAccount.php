<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "user_account".
 *
 * @property integer $uid
 * @property string $username
 * @property string $nickname
 * @property string $email
 * @property string $mobile
 * @property string $avatar
 * @property string $contact
 * @property string $product
 * @property string $parse_content
 * @property string $content
 * @property integer $score
 * @property integer $is_auth
 * @property integer $exp
 * @property string $level
 * @property integer $demand_count
 * @property integer $dynamic_count
 * @property integer $attention_count
 * @property integer $collection_count
 * @property integer $fans_count
 * @property integer $friend_count
 * @property string $level_number
 * @property integer $notify_count
 * @property string $kjt_tonken
 * @property string $password
 */
class UserAccount extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_account';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'nickname', 'mobile', 'attention_count', 'fans_count', 'friend_count', 'level_number', 'kjt_tonken', 'password'], 'required'],
            [['parse_content', 'content'], 'string'],
            [['score', 'is_auth', 'exp', 'demand_count', 'dynamic_count', 'attention_count', 'collection_count', 'fans_count', 'friend_count', 'notify_count','flag'], 'integer'],
            [['username', 'contact'], 'string', 'max' => 50],
            [['nickname'], 'string', 'max' => 100],
            [['email', 'avatar', 'product', 'kjt_tonken', 'password'], 'string', 'max' => 255],
            [['mobile', 'level', 'level_number'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => Yii::t('app', '用户编号'),
            'username' => Yii::t('app', '用户名'),
            'nickname' => Yii::t('app', '昵称'),
            'email' => Yii::t('app', '邮箱'),
            'mobile' => Yii::t('app', '手机'),
            'avatar' => Yii::t('app', '头像'),
            'contact' => Yii::t('app', '联系方式'),
            'product' => Yii::t('app', '主营产品'),
            'parse_content' => Yii::t('app', '企业背景'),
            'content' => Yii::t('app', '企业介绍'),
            'score' => Yii::t('app', '积分'),
            'is_auth' => Yii::t('app', '是否是可发布文章'),
            'exp' => Yii::t('app', '经验值 '),
            'level' => Yii::t('app', '等级'),
            'demand_count' => Yii::t('app', '发表供求数'),
            'dynamic_count' => Yii::t('app', '发表动态数'),
            'attention_count' => Yii::t('app', '关注数'),
            'collection_count' => Yii::t('app', '收藏数'),
            'fans_count' => Yii::t('app', '粉丝数'),
            'friend_count' => Yii::t('app', '好友数'),
            'level_number' => Yii::t('app', '等级'),
            'notify_count' => Yii::t('app', '通知数'),
            'kjt_tonken' => Yii::t('app', 'token'),
            'password' => Yii::t('app', '密码'),
            'flag'=>Yii::t('app', '是否可用'),
        ];
    }

  /**
     * 返回数据库字段信息，仅在生成CRUD时使用，如不需要生成CRUD，请注释或删除该getTableColumnInfo()代码
     * COLUMN_COMMENT可用key如下:
     * label - 显示的label
     * inputType 控件类型, 暂时只支持text,hidden  // select,checkbox,radio,file,password,
     * isEdit   是否允许编辑，如果允许编辑将在添加和修改时输入
     * isSearch 是否允许搜索
     * isDisplay 是否在列表中显示
     * isOrder 是否排序
     * udc - udc code，inputtype为select,checkbox,radio三个值时用到。
     * 特别字段：
     * id：主键。必须含有主键，统一都是id
     * create_date: 创建时间。生成的代码自动赋值
     * update_date: 修改时间。生成的代码自动赋值
     */
    public function getTableColumnInfo(){
        return array(
        'uid' => array(
                        'name' => 'uid',
                        'allowNull' => false,
//                         'autoIncrement' => true,
//                         'comment' => '用户编号',
//                         'dbType' => "int(20)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => true,
                        'phpType' => 'integer',
                        'precision' => '20',
                        'scale' => '',
                        'size' => '20',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('uid'),
                        'inputType' => 'hidden',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'username' => array(
                        'name' => 'username',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '用户名',
//                         'dbType' => "varchar(50)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '50',
                        'scale' => '',
                        'size' => '50',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('username'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'nickname' => array(
                        'name' => 'nickname',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '昵称',
//                         'dbType' => "varchar(100)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '100',
                        'scale' => '',
                        'size' => '100',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('nickname'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'email' => array(
                        'name' => 'email',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '邮箱',
//                         'dbType' => "varchar(255)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '255',
                        'scale' => '',
                        'size' => '255',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('email'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'mobile' => array(
                        'name' => 'mobile',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '手机',
//                         'dbType' => "varchar(20)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '20',
                        'scale' => '',
                        'size' => '20',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('mobile'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'avatar' => array(
                        'name' => 'avatar',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '头像',
//                         'dbType' => "varchar(255)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '255',
                        'scale' => '',
                        'size' => '255',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('avatar'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'contact' => array(
                        'name' => 'contact',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '联系方式',
//                         'dbType' => "varchar(50)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '50',
                        'scale' => '',
                        'size' => '50',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('contact'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'product' => array(
                        'name' => 'product',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '主营产品',
//                         'dbType' => "varchar(255)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '255',
                        'scale' => '',
                        'size' => '255',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('product'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'parse_content' => array(
                        'name' => 'parse_content',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '企业背景',
//                         'dbType' => "text",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'text',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('parse_content'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'content' => array(
                        'name' => 'content',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '企业介绍',
//                         'dbType' => "text",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'text',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('content'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'score' => array(
                        'name' => 'score',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '积分',
//                         'dbType' => "mediumint(8)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '8',
                        'scale' => '',
                        'size' => '8',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('score'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'is_auth' => array(
                        'name' => 'is_auth',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '是否是可发布文章',
//                         'dbType' => "smallint(1)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '1',
                        'scale' => '',
                        'size' => '1',
                        'type' => 'smallint',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('is_auth'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'exp' => array(
                        'name' => 'exp',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '经验值 ',
//                         'dbType' => "mediumint(8)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '8',
                        'scale' => '',
                        'size' => '8',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('exp'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'level' => array(
                        'name' => 'level',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '等级',
//                         'dbType' => "varchar(20)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '20',
                        'scale' => '',
                        'size' => '20',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('level'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'demand_count' => array(
                        'name' => 'demand_count',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '发表供求数',
//                         'dbType' => "mediumint(10)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('demand_count'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'dynamic_count' => array(
                        'name' => 'dynamic_count',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '发表动态数',
//                         'dbType' => "mediumint(10)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('dynamic_count'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'attention_count' => array(
                        'name' => 'attention_count',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '关注数',
//                         'dbType' => "mediumint(10)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('attention_count'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'collection_count' => array(
                        'name' => 'collection_count',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '收藏数',
//                         'dbType' => "mediumint(10)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('collection_count'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'fans_count' => array(
                        'name' => 'fans_count',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '粉丝数',
//                         'dbType' => "mediumint(10)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('fans_count'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'friend_count' => array(
                        'name' => 'friend_count',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '好友数',
//                         'dbType' => "mediumint(10)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('friend_count'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'level_number' => array(
                        'name' => 'level_number',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '等级',
//                         'dbType' => "varchar(20)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '20',
                        'scale' => '',
                        'size' => '20',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('level_number'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'notify_count' => array(
                        'name' => 'notify_count',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '通知数',
//                         'dbType' => "mediumint(10)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('notify_count'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
            'flag' => array(
                'name' => 'notify_count',
                'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '通知数',
//                         'dbType' => "mediumint(10)",
                'defaultValue' => '1',
                'enumValues' => null,
                'isPrimaryKey' => false,
                'phpType' => 'integer',
                'precision' => '1',
                'scale' => '',
                'size' => '1',
                'type' => 'integer',
                'unsigned' => false,
                'label'=>$this->getAttributeLabel('flag'),
                'inputType' => 'text',
                'isEdit' => true,
                'isSearch' => true,
                'isDisplay' => true,
                'isSort' => true,
//                         'udc'=>'',
            ),
		'kjt_tonken' => array(
                        'name' => 'kjt_tonken',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => 'token',
//                         'dbType' => "varchar(255)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '255',
                        'scale' => '',
                        'size' => '255',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('kjt_tonken'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'password' => array(
                        'name' => 'password',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '密码',
//                         'dbType' => "varchar(255)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '255',
                        'scale' => '',
                        'size' => '255',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('password'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		        );
        
    }
 
}
