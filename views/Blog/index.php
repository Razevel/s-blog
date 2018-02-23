<?php

use app\components\CategoryNav\CategoryNav;

$this->title = Yii::t('app','Home').' - SmileBlog.ru';
?>


<h1>Index</h1>
<?=CategoryNav::widget(); ?>


