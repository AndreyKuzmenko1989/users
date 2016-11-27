<?php
use  yii\helpers\HtmlPurifier;
$this->title="Список пользователей системой";
?>
<h1><b>Список пользователей</b></h1>
<p><a class="btn btn-info" href="<?= yii\helpers\Url::to(["blog/create"]) ?>" >Добавить новую запись от пользователя <?= Yii::$app->user->identity->username ?> </a></p>

<? if(!empty($posts)): ?>
 <?php foreach($posts as $post): ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><b>Имя пользователя: <a href ="<?= yii\helpers\Url::to(["blog/users/$post->id"]) ?>"><? echo HtmlPurifier::process($post->username)?></a></b></h3>
    </div>
    <div class="panel-body">
        <p><i><span>Email:   </span> <? echo HtmlPurifier::process($post->email) ?></i></p>
      <a class="btn btn-success" href="<?= yii\helpers\Url::to(["blog/users/$post->id"]) ?>" >Посмотреть записи пользователя <? echo HtmlPurifier::process($post->username) ?></a> 
    </div>
</div>
<? endforeach ;?>
<?= \yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
<? endif ;?>



