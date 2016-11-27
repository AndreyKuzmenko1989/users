<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title="Админиская часть";
if(Yii::$app->user->identity->username =="Admin"){
$model->auth_key = \Yii::$app->security->generateRandomString();
$model->created_at =new \yii\db\Expression('NOW()');
$model->updated_at =new \yii\db\Expression('NULL');
?>
<div class="row">
    <div class="col-md-12">
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->label('Имя нового пользователя') ?>

    <?= $form->field($model, 'auth_key')->hiddenInput()->label(false) ?>
    
    <?= $form->field($model, 'password_hash')->label('Введите пароль') ?>
    <?= $form->field($model, 'password_reset_token') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'status') ?>
    <?= $form->field($model, 'created_at')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'updated_at')->hiddenInput()->label(false) ?>
    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end();
}
else{?>
        <h3>Войдите под администратором если вы он, либо нажмите на кнопку Logout</h3>
          <? }?> 
    </div>
</div>