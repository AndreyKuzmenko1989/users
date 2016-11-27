<?
use  yii\helpers\HtmlPurifier;
$this->title = "Окно сообщений пользователя";
?>
<p><a class="btn btn-default" href="<?= yii\helpers\Url::to(["blog/users/"]) ?>" >Вернуться в список пользователей </a> </p>
<?php if($id_check == 1){
$this->title = "Ваш личный кабинет пользователь : ".Yii::$app->user->identity->username ;
?>
<p><a class="btn btn-info" href="<?= yii\helpers\Url::to(["blog/create"]) ?>" >Добавить новую запись от пользователя <?= Yii::$app->user->identity->username ?> </a></p>
<? }    ?>
<? if(!empty($posts)): ?>

<h1>Список записей</h1>
 <?php foreach($posts as $post): ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><a href ="<?= yii\helpers\Url::to(["blog/$post->id_post/"]) ?>"><b><? echo HtmlPurifier::process($post->title) ?></b></a></h3>
    </div>
    <div class="panel-body">
      <p> <i> <?
    $text = HtmlPurifier::process($post->text);
    $preview = mb_substr( $text,0,120,'utf-8');
    if(strlen($text)>120){
        $preview.=" ....";
    }
    echo $preview; 
          ?></i></p>
      <a class="btn btn-success" href="<?= yii\helpers\Url::to(["blog/$post->id_post/"]) ?>" >Посмотреть полный текст записи : <? echo HtmlPurifier::process($post->title)?></a> 
    </div>
</div>
<? endforeach ;?>
<?= \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
<? endif ;?>
<? if(empty($posts)): ?>
<h1><b>У этого пользователя нет записей</b></h1>
<a class="btn btn-success" href="<?= yii\helpers\Url::to(["blog/users/"]) ?>" >Перейти в список пользователей </a> 
<?php if($id_check == 1){?>
<a class="btn btn-success" href="<?= yii\helpers\Url::to(["blog/create"]) ?>" >Создать первую запись</a> 
<? }    ?>
<? endif ;?>
