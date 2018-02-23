<?php

use app\components\CategoryNav\CategoryNav;

use \yii\helpers\StringHelper;
use yii\helpers\Url;
			
$this->title =  'Название статьи - SmileBlog.ru';
$article = $model['article'];
$img_path = Url::to('@web/images/articles/'.$article['image']);
$pub_time = strtotime($article['pub_date']);

?>

<img src="<?=$img_path?>" alt="<?=$article['title']?>"/>
<div class="blog-grid">
	<div class="grid-left">
		<span class="e"> </span>
	   	<h3><?=date('d', $pub_time)?></h3>
		<p><?=date('M', $pub_time)?></p>
	</div>
	<div class="grid-right">
		<h3><?=$article['title']?></h3>
		<ul class="blog-list">
			  	<li>
			  		<span class="mike"> </span>
			  		<a href="#">admin</a>
			  	</li>
			  	<li>
			  		<span class="box"> </span>
			  		<a href="#"><?=$article['category_id']?></a>
			  	</li>
				<li>
					<span class="comm"> </span>
					<a href="#"><?=Yii::t('app', 'Comments')?> (0)</a>
				</li>
			</ul>
	</div>
	<div class="clearfix"> </div>
</div>
<div class="blog-para">

<?=$article['text']?>

</div>

<div class="blog-contact">
    <h3><?=Yii::t('app', 'LEAVE A COMMENT')?></h3>
    <p>
    	<?=Yii::t('app', 'Tell everyone what You think about it.')?> 
    	<?=Yii::t('app', 'Leave a comment so that other users know about it.')?>
    	
    </p>
    <input type="text" value="Your Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Your Name';}"/>
    <input type="text" value="Your Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Your Email';}"/>
    <textarea onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}"/>Message</textarea>
    <input type="submit" value="LEAVE THE REPLY">
</div>
<div class="clearfix"> </div>
