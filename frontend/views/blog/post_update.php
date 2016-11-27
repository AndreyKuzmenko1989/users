<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title ="Окно обновление записи: $post_data->title";
    if(!empty($post_data)){
        
        $model->title = $post_data->title;
        $model->text = $post_data->text;
       // $model->date_add = $post_data->date_add;
       // $model->date_upd = $post_data->date_upd;
        $model->pub_key = $post_data->pub_key;
        $model->id_user = $post_data->id_user;
    }
?>
<div class="row">
    <div class="col-md-12">
    
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput()->label('Название записи') ?>

    <?= $form->field($model, 'text')->textArea(['rows' => '30'])->label('Текст записи') ?>
    
    <?= $form->field($model, 'pub_key')->dropDownList($key,[
    
    'prompt'=>'выбрать...',
    ])->label(false) ?>
    <?= $form->field($model, 'id_user')->hiddenInput()->label(false) ?>
    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        <a class="btn btn-warning" href="<?= yii\helpers\Url::to(["blog/users/$model->id_user"]) ?>" >Вернуться в список записей пользователя </a> 
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>