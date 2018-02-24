<?php

use app\components\CategoryNav\CategoryNav;

use \yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title =  Yii::t('app', 'All tags').' - SmileBlog.ru';

?>

<div class="tags">
	<ul>
		<?php foreach ($model['tags'] as $tag): ?>
		<li>
			<a href="<?=Url::to(['blog/tag', 'id' => $tag['id']])?>">
				#<?=Html::encode($tag['title'])?> (<?=count($tag['articles'])?>)
			</a>
		</li>
		<?php endforeach;?>
	</ul>
</div>