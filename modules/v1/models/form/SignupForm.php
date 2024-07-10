<?php

namespace app\modules\v1\models\form;

use app\models\User;
use app\modules\v1\models\resource\UserResource;
use Yii;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 */
class SignupForm extends \app\models\LoginForm
{
     public $username;
     public $password_hash;

     public $password_repeat;
     public $_user = false;


     /**
      * @return array the validation rules.
      */
     public function rules()
     {
          return [
               ['username', 'unique', 'targetClass' => UserResource::class, 'message' => 'This username has already been taken.'],
               [['username', 'password_hash', 'password_repeat'], 'required'],
               ['password_hash', 'compare', 'compareAttribute' => 'password_repeat'],
          ];
     }

     public function register()
     {
          if ($this->validate()) {
               $security = Yii::$app->security;

               $this->_user = new UserResource();
               $this->_user->username = $this->username;
               $this->_user->password_hash = $security->generatePasswordHash($this->password_hash);
               $this->_user->access_token = $security->generateRandomString(255);
               if ($this->_user->save()) {
                    return true;
               }
               return false;
          }

          // if not passed then
          return false;
     }
}
