<?php

namespace frontend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "post".
 *
 * @property integer $id_post
 * @property string $title
 * @property string $text
 * @property string $date_add
 * @property string $date_upd
 * @property integer $pub_key
 * @property integer $id_user
 *
 * @property User $idUser
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'text', 'date_add', 'id_user'], 'required'],
            [['date_add', 'date_upd'], 'safe'],
            [['pub_key', 'id_user'], 'integer'],
            [['title'], 'string', 'max' => 200],
            [['text'], 'string', 'max' => 5000],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_post' => 'Id Post',
            'title' => 'Title',
            'text' => 'Text',
            'date_add' => 'Date Add',
            'date_upd' => 'Date Upd',
            'pub_key' => 'Pub Key',
            'id_user' => 'Id User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
   // -------------------------------------------
    // Добавлено мной
    public static function primaryKey()
{
    return 'id';
}
    public static function list_post($id_user)
    {
        return static::find()->where(['id_user' => $id_user]);
        //Записи пользователя
    }
    public static function list_not_user($id_user)
    {
       return static::find()->where(['pub_key' => 1])->andWhere(['id_user' => $id_user]);
    }
    public static function getpost($id)
    {
        return static::findOne(['id_post' => $id]);
    }
    
    public static function getpost_upd($id)
    {
        return static::findOne(['id_post' => $id,]);
    }
   /* public static function update_post($id_post,$title,$text,$date_upd,$pub_key,$id_user) 
    {
        
        $post = static::findOne(['id_post' => $id]);
        $post->title = $title;
        $post->text = $text;
        $post->date_upd = $date_upd;
        $post->pub_key = $pub_key;
        $post->id_user = $id_user;
        $post->update();
                
    }*/
    public static function create_post($title,$text,$date_add,$date_upd,$pub_key,$id_user)
    {
        $post_new = new Post();
        $post_new->title = $title;
        $post_new->text = $text;
        $post_new->date_add = $date_add;
        $post_new->date_upd = $date_upd;
        $post_new->pub_key = $pub_key;
        $post_new->id_user = $id_user;
        $post_new->save();
    }
    
    
    public static function all_list()
    {
        return static::find()->all();
    }
    
   //------------------------------- 
   /* public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }*/
}
