<?php

namespace frontend\controllers;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

class UserController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $user = new User();
        $query = $user->find()->select('username,email, created_at ,id')->orderBy('username ASC');
        $pages = new \yii\data\Pagination(['totalCount' => $query->count(), 'pageSize' => 5, 'pageSizeParam' => false, 'forcePageParam' => false]);
        $posts = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('list',compact('posts','pages'));
    }
    //blog/users/

}
