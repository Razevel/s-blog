<?php

use app\components\CategoryNav\CategoryNav;

use \yii\helpers\StringHelper;
use yii\helpers\Url;
			
$this->title = Yii::t('app','New articles').' - SmileBlog.ru';
?>

<?php foreach ($model['articles'] as $article): ?>
<?php
	$img_path = Url::to('@web/images/articles/'.$article['image']);
	$pub_time = strtotime($article['pub_date']);
?>

<div class="blog-section">
	<a href="single.html">
		<img src="<?=$img_path?>" alt="<?=$article['title']?>"/>
	</a>
	<div class="grid">
	 	<div class="grid-left">
		  	<span class="f"> </span>
		   	<h3><?=date('d', $pub_time)?></h3>
		   	<p><?=date('M', $pub_time)?></p>
		</div>
		<div class="grid-right">
		  	<a href="#">
				<h3><?=$article['title']?></h3>
			</a>
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
			<p><?=StringHelper::truncate($article['text'], 150, '...')?></p>
			<a class="bwn" href="single.html"><?=Yii::t('app', 'READ MORE')?></a>
		</div>
		<div class="clearfix"> </div>
	</div>
</div>
<?php endforeach; ?>

<div class="pag-nations">
	<ul class="p_n-list">
		<li><a href="#">Prev</a></li>
		<li><a href="#">1</a></li>
		<li><a href="#">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#">More</a></li>
		<li><a href="#">19</a></li>
		<li><a href="#">20</a></li>
		<li><a href="#">Next</a></li>
	</ul>
</div>
			
			
	

