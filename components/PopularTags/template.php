<?php
use yii\helpers\Url;
?>

<li>
	<a href="<?=Url::to(['blog/tag', 'id' => $tag['tag_id']])?>"><?=$tag['tag_title']?></a>
</li>
				