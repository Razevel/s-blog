<?php

use app\components\CategoryNav\CategoryNav;

use \yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title =  Yii::t('app', 'Subscription').' - SmileBlog.ru';
?>

<?php if( $result['success'] ):?>

<div class="alert alert-success">
	<p><?=Yii::t('app', 'Thanks for subscribing! We are very pleased that you are with us')?></p>
</div>

<?php else: ?>

<div class="alert alert-danger">
    <p><?=Yii::t('app', 'Unable to subscribe, an error occurred')?>: 
    "<?= $error ?>"</p>
</div>

<?php endif;?>

<hr>

<a href="<?=$backUrl?>"><?=Yii::t('app', 'Go back')?>...</a>