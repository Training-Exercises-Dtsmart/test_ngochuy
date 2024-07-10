<?php

namespace app\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\web\Controller;

/**
 * Product controller for the `v1` module
 */
class ProductController extends ActiveController
{
    public $modelClass = 'app\models\Product';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => \yii\filters\auth\HttpHeaderAuth::class,
        ];

        return $behaviors;
    }
}
