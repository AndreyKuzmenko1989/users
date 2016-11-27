<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title ="Окно добавления записей";
$model->id_user = $id_post;
?>
<div class="row">
    <div class="col-md-12">
    
        <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->label('Название записи') ?>

    <?= $form->field($model, 'text')->textArea(['rows' => '30'])->label('Текст записи') ?>
    
    <?= $form->field($model, 'pub_key')->dropDownList($key,[
    
    'prompt'=>'выбрать...',
    ])->label(false) ?>

   <?= $form->field($model, 'id_user')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        <a class="btn btn-warning" href="<?= yii\helpers\Url::to(["blog/users/"]) ?>" >Вернуться к списку пользователей </a> 
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>