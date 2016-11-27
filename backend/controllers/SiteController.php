<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use backend\models\UserForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new UserForm();
        $user = new User();
        $request = \Yii::$app->request;
        if ($model->load($request->post()) && $model->validate()) {
            $username = $model->username;
            $auth_key = $model->auth_key;
            $password_hash =Yii::$app->getSecurity()->generatePasswordHash($model->password_hash);
            $password_reset_token = $model->password_reset_token;
            $email = $model->email;
            $status =$model->status;
            $created_at = $model->created_at;
            $updated_at = $model->updated_at;
            
            $data = $user::create_item($username,$auth_key,$password_hash,$password_reset_token,$email,$status,$created_at,$updated_at);
            ///////////////////////////////////////////////////////////////////////////////////
            
            //return $this->render('user_form',compact('data'));
            } 
            else {
                // либо страница отображается первый раз, либо есть ошибка в данных
                return $this->render('user_form', compact('model'));
            }
    }

    /**
     * Login action.
     *
     * @return string
     */
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

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
