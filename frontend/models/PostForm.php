<?php
namespace frontend\models;
use yii\base\Model;
use common\models\Post;

class PostForm extends Model
{
    public $title;
    public $text;
   // public $date_add;
    //public $date_upd;
    public $pub_key;
    public $id_user;
    
    public function rules()
    {
        return [
            [['title', 'text','pub_key','id_user'], 'required'],
           
        ];
    }
}