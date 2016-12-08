<?php
namespace backend\models;

use Yii;

/**
 * This is the model class for table "demand".
 *
 * @property integer $id
 * @property string $title
 * @property integer $view
 * @property string $create_time
 * @property string $price
 * @property string $unit
 * @property integer $number
 * @property integer $buy_or_sale
 * @property integer $area
 * @property string $area_title
 * @property integer $category_id
 * @property string $category_name
 * @property string $category_title
 * @property integer $group_id
 * @property string $group_title
 * @property string $address
 * @property string $parse_content
 * @property integer $uid
 * @property integer $pos
 * @property integer $flag
 * @property integer $sort
 * @property string $tags
 *
 * @property DemandCategory $category
 * @property DemandGroup $group
 * @property UserAccount $u
 */
class Demand extends \backend\models\BaseModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'demand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'category_id', 'parse_content', 'uid', 'tags'], 'required'],
            [['view', 'number', 'buy_or_sale', 'area', 'category_id', 'group_id', 'uid', 'pos', 'flag', 'sort'], 'integer'],
            [['create_time'], 'safe'],
            [['price'], 'number'],
            [['parse_content'], 'string'],
            [['title', 'group_title'], 'string', 'max' => 100],
            [['unit', 'area_title'], 'string', 'max' => 20],
            [['category_name', 'category_title'], 'string', 'max' => 200],
            [['address', 'tags'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', '编号'),
            'title' => Yii::t('app', '标题'),
            'view' => Yii::t('app', '查看次数'),
            'create_time' => Yii::t('app', '创建时间'),
            'price' => Yii::t('app', '价格'),
            'unit' => Yii::t('app', '单位'),
            'number' => Yii::t('app', '数据'),
            'buy_or_sale' => Yii::t('app', '供求标识(供1 求2)'),
            'area' => Yii::t('app', '地区'),
            'area_title' => Yii::t('app', '区名'),
            'category_id' => Yii::t('app', '分类编号'),
            'category_name' => Yii::t('app', '分类英文名'),
            'category_title' => Yii::t('app', '类名'),
            'group_id' => Yii::t('app', '组编号'),
            'group_title' => Yii::t('app', '组名'),
            'address' => Yii::t('app', '地址'),
            'parse_content' => Yii::t('app', '内容'),
            'uid' => Yii::t('app', 'Uid'),
            'pos' => Yii::t('app', '推荐'),
            'flag' => Yii::t('app', '状态(1为正常  0为下架)'),
            'sort' => Yii::t('app', '排序'),
            'tags' => Yii::t('app', '标签'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(DemandCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(DemandGroup::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(UserAccount::className(), ['uid' => 'uid']);
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
        'id' => array(
                        'name' => 'id',
                        'allowNull' => false,
//                         'autoIncrement' => true,
//                         'comment' => '编号',
//                         'dbType' => "bigint(10)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => true,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'bigint',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('id'),
                        'inputType' => 'hidden',
                        'isEdit' => true,
                        'isSearch' => true,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'title' => array(
                        'name' => 'title',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '标题',
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
                        'label'=>$this->getAttributeLabel('title'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'view' => array(
                        'name' => 'view',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '查看次数',
//                         'dbType' => "mediumint(20)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '20',
                        'scale' => '',
                        'size' => '20',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('view'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'create_time' => array(
                        'name' => 'create_time',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '创建时间',
//                         'dbType' => "timestamp",
                        'defaultValue' => 'CURRENT_TIMESTAMP',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '',
                        'scale' => '',
                        'size' => '',
                        'type' => 'timestamp',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('create_time'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'price' => array(
                        'name' => 'price',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '价格',
//                         'dbType' => "decimal(10,0)",
                        'defaultValue' => '0',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '10',
                        'scale' => '0',
                        'size' => '10',
                        'type' => 'decimal',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('price'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'unit' => array(
                        'name' => 'unit',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '单位',
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
                        'label'=>$this->getAttributeLabel('unit'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'number' => array(
                        'name' => 'number',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '数据',
//                         'dbType' => "int(10)",
                        'defaultValue' => '1000',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('number'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'buy_or_sale' => array(
                        'name' => 'buy_or_sale',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '供求标识(供1 求2)',
//                         'dbType' => "smallint(1)",
                        'defaultValue' => '1',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '1',
                        'scale' => '',
                        'size' => '1',
                        'type' => 'smallint',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('buy_or_sale'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'area' => array(
                        'name' => 'area',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '地区',
//                         'dbType' => "int(3)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '3',
                        'scale' => '',
                        'size' => '3',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('area'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'area_title' => array(
                        'name' => 'area_title',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '区名',
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
                        'label'=>$this->getAttributeLabel('area_title'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'category_id' => array(
                        'name' => 'category_id',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '分类编号',
//                         'dbType' => "int(11)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '11',
                        'scale' => '',
                        'size' => '11',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('category_id'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'category_name' => array(
                        'name' => 'category_name',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '分类英文名',
//                         'dbType' => "varchar(200)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '200',
                        'scale' => '',
                        'size' => '200',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('category_name'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'category_title' => array(
                        'name' => 'category_title',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '类名',
//                         'dbType' => "varchar(200)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'string',
                        'precision' => '200',
                        'scale' => '',
                        'size' => '200',
                        'type' => 'string',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('category_title'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'group_id' => array(
                        'name' => 'group_id',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '组编号',
//                         'dbType' => "int(10)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('group_id'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'group_title' => array(
                        'name' => 'group_title',
                        'allowNull' => true,
//                         'autoIncrement' => false,
//                         'comment' => '组名',
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
                        'label'=>$this->getAttributeLabel('group_title'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'address' => array(
                        'name' => 'address',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '地址',
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
                        'label'=>$this->getAttributeLabel('address'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'parse_content' => array(
                        'name' => 'parse_content',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '内容',
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
		'uid' => array(
                        'name' => 'uid',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '',
//                         'dbType' => "int(20)",
                        'defaultValue' => '',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '20',
                        'scale' => '',
                        'size' => '20',
                        'type' => 'integer',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('uid'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'pos' => array(
                        'name' => 'pos',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '推荐',
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
                        'label'=>$this->getAttributeLabel('pos'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'flag' => array(
                        'name' => 'flag',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '状态(1为正常  0为下架)',
//                         'dbType' => "mediumint(1)",
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
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'sort' => array(
                        'name' => 'sort',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '排序',
//                         'dbType' => "bigint(10)",
                        'defaultValue' => '999',
                        'enumValues' => null,
                        'isPrimaryKey' => false,
                        'phpType' => 'integer',
                        'precision' => '10',
                        'scale' => '',
                        'size' => '10',
                        'type' => 'bigint',
                        'unsigned' => false,
                        'label'=>$this->getAttributeLabel('sort'),
                        'inputType' => 'text',
                        'isEdit' => true,
                        'isSearch' => false,
                        'isDisplay' => true,
                        'isSort' => true,
//                         'udc'=>'',
                    ),
		'tags' => array(
                        'name' => 'tags',
                        'allowNull' => false,
//                         'autoIncrement' => false,
//                         'comment' => '标签',
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
                        'label'=>$this->getAttributeLabel('tags'),
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
