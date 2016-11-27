<?php
namespace frontend\controllers;
use yii;
use yii\filters\VerbFilter;
use yii\base\Model;
use yii\web\Controller;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\data\ActiveDataProvider;
use frontend\models\Post;
use frontend\models\PostForm;
use common\models\User;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\helpers\Url;
use  yii\web\HttpException;




class BlogController extends \yii\web\Controller
{
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
     public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Проверьте свою почту для дальнейших инструкций.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Простите у нас отменёно востанавление паролей через почту.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
     public function actionUserPost($id=1)
    {
        $post = new Post();
       // print_r(Yii::$app->user->getId());
       if($id ==  Yii::$app->user->getId() ){
            $query = $post::list_post($id);
            $id_check = 1;
        }
        else{
             $query = $post::list_not_user($id);  
             $id_check = 0;
        }
        
        $pages = new \yii\data\Pagination(['totalCount' => $query->count(), 'pageSize' => 5, 'pageSizeParam' => false, 'forcePageParam' => false]);
        $posts = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('user_post',compact('posts','pages','id_check'));
        //blog/users/2/ 
         
    }
     public function actionPost($id)
    {
        $post = new Post();
        $data = $post::getpost($id);
         if($data->id_user == Yii::$app->user->getId()){
            $user_check = 1;
            return $this->render('post',compact('data','user_check'));
        }
        elseif($data->pub_key != 0){
            $user_check = 0;
            return $this->render('post',compact('data','user_check'));
        }
         else{
             $data = NULL;
             return $this->render('post',compact('data'));
             
         }
            
    }
       //blog/2/
         
    //}
    public function actionPostUpdate($id)
    {
        $model = new PostForm();
        $post = new Post();
        $post_data = $post::getpost_upd($id);
        if($post_data->id_user == Yii::$app->user->getId()){
            $request = \Yii::$app->request;
            $key[0]="Не опубликовывать";
            $key[1]="Опубликовывать";
            if ($model->load($request->post()) && $model->validate()) {
            // print_r($request->post());
             $id_post = $id;  
             $title = $model->title;
             $text = $model->text;
             $date_add = $post_data->date_add;
             $date_upd = date("Y-m-d");
             $pub_key = $model->pub_key;
             $id_user =$model->id_user;
            \Yii::$app->db->createCommand("UPDATE post SET title='$title', text='$text',date_upd = '$date_upd' ,pub_key = $pub_key,id_user =$id_user WHERE id_post=$id_post")->execute();
             return Yii::$app->response->redirect(["blog/$id"]);
        }
        else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            return $this->render('post_update', compact('model','post_data','key'));
            }
        }
        else{
            throw new HttpException(404 ,'У вас нет прав редактировать этот пост!');
        }
                
    }
    public function actionPostCreate()
    {
        $model = new PostForm();
        $post = new Post();
        $request = \Yii::$app->request;
       
        $key[0]="Не опубликовывать";
        $key[1]="Опубликовывать";
        $id_post = Yii::$app->user->getId();
        if ($model->load($request->post()) && $model->validate()) {
            // print_r($request->post());
            $title = $model->title;
            $text =$model->text;
            $date_add = new \yii\db\Expression('NOW()');
            $date_upd =new \yii\db\Expression('NULL');
            $pub_key = $model->pub_key;
            $id_user =$model->id_user;
            $data = $post::create_post($title,$text,$date_add,$date_upd,$pub_key,$id_user);
            ///////////////////////////////////////////////////////////////////////////////////
            return Yii::$app->response->redirect(["blog/users/$id_user"]);
        } 
        else{
                // либо страница отображается первый раз, либо есть ошибка в данных
                return $this->render('post_form', compact('model','id_post','key'));
            }
       //blog/create
         
    }
   
    

}