<?php

namespace app\modules\models\form;

use app\models\User;


class UserForm extends User
{
    public function rules()
    {
        return array_merge(
            parent::rules(),
            [
                [['username', 'password_hash',], 'required'],
            ]
        );
    }
}
