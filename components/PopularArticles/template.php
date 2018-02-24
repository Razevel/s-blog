<?php

use \yii\helpers\StringHelper;
use yii\helpers\Url;

?>

<li>
    <h5 style="margin-bottom: 8px;">
    	<a href="<?=Url::to(['blog/article', 'id' => $article['id']])?>">
    		<?=StringHelper::truncate($article['title'], 45, '...')?>
    	</a>
    </h5>
    <span class="g"> </span>
    <a href="<?=Url::to(['blog/article', 'id' => $article['id']])?>"><?=$article['views']?></a>
  	<span class="h"></span>
   <a href="#">admin</a>
</li>
