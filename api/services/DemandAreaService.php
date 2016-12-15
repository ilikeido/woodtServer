<?php
namespace api\services;

use api\models\DemandArea;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class DemandAreaService extends DemandArea{

    public static function getAllAreaNames(){
        $query = (new Query())->select('id,area')->from('demand_area')->orderBy('sort, id');
        $result = $query->all();
        return ArrayHelper::map($result,'id','area');
    }
   
}
