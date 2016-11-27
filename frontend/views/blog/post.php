<?
use  yii\helpers\HtmlPurifier;
use  yii\web\HttpException;
$this->title = "Просмотр записи: $data->title ";
if($data ==NULL){
throw new HttpException(404 ,'Запись не найдена! Введите корректное id .');
}
?>
<title><? echo HtmlPurifier::process($data->title)  ?></title>
<p>
<div class="well well-sm">
    <h2><p class="text-center"><b><? echo HtmlPurifier::process($data->title) ?></b></p> </h2>
 </div>   
</p>
 <p>
<div class="well well-lg">
    <i> <? echo HtmlPurifier::process($data->text) ?></i>
</div>

</p>
<? if($user_check == 1){?>
<a class="btn btn-success" href="<?= yii\helpers\Url::to(["blog/users/$data->id_user"]) ?>" >Перейти в список записей пользователя </a> 
<a class="btn btn-success" href="<?= yii\helpers\Url::to(["blog/$data->id_post/update"]) ?>" >Редактировать запись</a>


 <? }
else 
    { ?>
<a class="btn btn-success" href="<?= yii\helpers\Url::to(["blog/users/$data->id_user"]) ?>" >Перейти в список записей пользователя </a>
</div>
<?  } ?>