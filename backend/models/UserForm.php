<?php
namespace backend\models;
use yii\base\Model;
use common\models\User;

class UserForm extends Model
{
    public $id;
    public $username;
    public $auth_key;
    public $password_hash;
    public $password_reset_token;
    public $email;
    public $status;
    public $created_at;
    public $updated_at;
    
    public function rules()
    {
        return [
            [['username', 'auth_key','password_hash','status','email','created_at','updated_at'], 'required'],
           
        ];
    }
}