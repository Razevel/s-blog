<?php

use app\components\CategoryNav\CategoryNav;

use \yii\helpers\StringHelper;
use yii\helpers\Url;
			
$this->title =  Yii::t('app', 'All tags').' - SmileBlog.ru';

?>

<div class="tags">
	<ul>
		<?php foreach ($model['tags'] as $tag): ?>
		<li>
			<a href="<?=Url::to(['blog/tag', 'id' => $tag['id']])?>">
				#<?=$tag['title']?> (<?=count($tag['articles'])?>)
			</a>
		</li>
		<?php endforeach;?>
	</ul>
</div>