<?php

use app\components\CategoryNav\CategoryNav;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = $model['title'].' - SmileBlog.ru';
//$this->title = Yii::t('app','New articles');
?>

<?php foreach ($model['articles'] as $article): ?>
<?php
	$img_path = Url::to('@web/images/articles/'.$article['image']);
	$pub_time = strtotime($article['pub_date']);
?>

<div class="blog-section">
	<a href="<?=Url::to(['blog/article', 'id' => $article['id']])?>">
		<img src="<?=$img_path?>" alt="<?=$article['title']?>"/>
	</a>
	<div class="grid">
	 	<div class="grid-left">
		  	<span class="f"></span>
		   	<h3><?=date('d', $pub_time)?></h3>
		   	<p><?=date('M', $pub_time)?></p>
		</div>
		<div class="grid-right">
		  	<a href="<?=Url::to(['blog/article', 'id' => $article['id']])?>">
				<h3><?=Html::encode($article['title'])?></h3>
			</a>
			<p style="margin: 15px 0px">
			<?php foreach($article['tags'] as $tag): ?>
				<a href="<?=Url::to(['blog/tag', 'id' => $tag['id']])?>">
					#<?=Html::encode($tag['title'])?>
				</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<?php endforeach;?>
			
			</p>
			<ul class="blog-list">
			  	<li>
			  		<span class="mike"> </span>
			  		<a href="#">admin</a>
			  	</li>
			  	<li>
			  		<span class="box"> </span>
			  		<a href="<?=Url::to(['blog/category', 'id' => $article['category']['id']])?>"><?=Html::encode($article['category']['title'])?></a>
			  	</li>
				<li>
					<span class="comm"> </span>
					<a href="<?=Url::to(['blog/article', 'id' => $article['id'], '#' => 'comments'])?>"><?=Yii::t('app', 'Comments')?> (<?=count($article['comments'])?>)</a>
				</li>
			</ul>
			<p><?=StringHelper::truncate(Html::encode($article['text']), 150, '...')?></p>
			<a class="bwn" href="<?=Url::to(['blog/article', 'id' => $article['id']])?>">
				<?=Yii::t('app', 'READ MORE')?>
			</a>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<hr style="border-color: rgba(0,0,0,0.3);">
<?php endforeach; ?>


<div class="pag-nations">

<?= \yii\widgets\LinkPager::widget(
	[
		'pagination' => $pages, 
	]) ?>

</div>

			
			
	

