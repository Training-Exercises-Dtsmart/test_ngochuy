<?php

namespace app\modules\v1\models\pagination;

use yii\data\ActiveDataProvider;

class Pagination 
{
    public static function getPagination($query, $pageSize, $sort)
    {
        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $pageSize,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => $sort,
                ],
            ],
        ]);

        return $provider;

    }
}