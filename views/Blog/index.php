<?php

use app\components\CategoryNav\CategoryNav;

use \yii\helpers\StringHelper;
use yii\helpers\Url;

$this->title = Yii::t('app','New articles').' - SmileBlog.ru';
?>

<div class="blog">
	<div class="container">
		
		<div class="blog-main">
			<div class="blog-top"><?=Yii::t('app', 'NEW ARTICLES')?></div>
			
			<div class="col-md-8 blog-left">
				   
			<?php foreach ($model['articles'] as $article): ?>
				
				<?php
					$img_path = Url::to('@web/images/articles/'.$article['image']);
					$pub_time = strtotime($article['pub_date']);
				?>

				<div class="blog-section">
					<a href="single.html"> <img src="<?=$img_path?>" alt="<?=$article['title']?>"/></a>
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
					   	   	  	<li><span class="mike"> </span><a href="#">admin</a></li>
					   	   	  	<li><span class="box"> </span><a href="#"><?=$article['category_id']?></a></li>
					   	   	   	<li><span class="comm"> </span><a href="#">
					   	   	   		<?=Yii::t('app', 'Comments')?> (0)</a></li>
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
			</div>
			<div class="col-md-4 blog-right"> 
				<div class="sear">
					<input type="text" value="SEARCH.." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'SEARCH..';}"/>
					<input type="submit" value="">
				</div>
				
				<h3> <?=Yii::t('app', 'CATEGORIES')?></h3>
				<?=CategoryNav::widget(); ?>
				<h3>POPULAR POSTS</h3>
				<ul class="popular">
					<li><h5> Make a Type Specimen Book</h5><span class="g"> </span><a href="#">1280</a><span class="h"> </span><a href="#">Milk</a></li>
					<li><h5>Most Popular Post</h5><span class="g"> </span><a href="#">1011</a><span class="h"> </span><a href="#">Elly</a></li>
					<li><h5> Popularised Post</h5><span class="g"> </span><a href="#">956</a><span class="h"> </span><a href="#">Vall</a></li>
				</ul>
				<h3>POPULAR TAGS</h3>
				<ul class="popular-tag">
					<li><a href="#">Design</a></li>
					<li><a href="#">Branding</a></li>
					<li><a href="#">Art</a></li>
					<li><a href="#">Developing</a></li>
					<li><a href="#">CSS</a></li>
					<li><a href="#">HTML</a></li>
					<li><a href="#">Wordpress</a></li>
					<li><a href="#">Photography</a></li>
				</ul>
				<h3>SUBSCRIBE FOR NEWSLETTER</h3>
				<div class="subscribe">
					<p>Duis vitae velit mollis,Pellentesque lorem</p>
				<div class="sub">
					<input type="text" value="YOUR EMAIL ADDRESS" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'YOUR EMAIL ADDRESS';}"/>
					<input type="submit" value="SUBSCRIBE">
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
</div>

