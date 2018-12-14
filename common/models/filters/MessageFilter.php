<?php

namespace common\models\filters;

use yii\base\Model;
use yii\db\ActiveQuery;

class MessageFilter extends Model
{
    public function filter($filter, ActiveQuery $query)
    {
        $query->filterWhere([
            'user_id' => $filter['user_id']
        ]);
        return $query;
    }

}