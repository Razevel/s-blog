<?php

use app\components\CategoryNav\CategoryNav;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'CRUD - SmileBlog.ru';
?>

<ul>
	<li><a href="<?=Url::to(['article/index'])?>">Статьи</a></li>
	<li><a href="<?=Url::to(['tag/index'])?>">Теги</a></li>
	<li><a href="<?=Url::to(['article-tags/index'])?>">Теги в статьях</a></li>
	<li><a href="<?=Url::to(['category/index'])?>">Категории</a></li>
</ul>