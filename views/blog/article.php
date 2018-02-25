<?php

use app\components\CategoryNav\CategoryNav;
use app\models\Comment;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title =  StringHelper::truncate(Html::encode($model['article']['title']), 50, '...').' - SmileBlog.ru';

$comment_model = new Comment();
$article = $model['article'];
$img_path = Url::to('@web/images/articles/'.$article['image']);
$pub_time = strtotime($article['pub_date']);

?>


<div class="blog-contact" id="blog-contact" style="margin-bottom: 3em">


<img src="<?=$img_path?>" alt="<?=$article['title']?>"/>
<div class="blog-grid">
	<div class="grid-left">
		<span class="e"> </span>
	   	<h3><?=date('d', $pub_time)?></h3>
		<p><?=date('M', $pub_time)?></p>
	</div>
	<div class="grid-right">
		<h3><?=Html::encode($article['title'])?></h3>
		<ul class="blog-list" style="margin-top: 15px;">
			  	<li>
			  		<span class="mike"> </span>
			  		<a href="#">admin</a>
			  	</li>
			  	<li>
			  		<span class="box"> </span>
			  		<a href="<?=Url::to(['blog/category', 'id' => $article->category['id']])?>"><?=Html::encode($article->category['title'])?></a>
			  	</li>
				<li>
					<span class="comm"> </span>
					<a href="#comments"><?=Yii::t('app', 'Comments')?> (<?=count($article['comments'])?>)</a>
				</li>
			</ul>
	</div>
	<div class="clearfix" style="margin-bottom: 20px;"> </div>

</div>

<div class="blog-para"><?=$article['text']?></div>

<div class="tags">
	<ul>
		<?php foreach ($article->tags as $tag): ?>
		<li>
			<a href="<?=Url::to(['blog/tag', 'id' => $tag['id']])?>">
				#<?=Html::encode($tag['title'])?>
			</a>
		</li>
		<?php endforeach;?>
	</ul>
</div>

<?php 
$comment = new Comment(); 
$form = ActiveForm::begin([
	'action' => Url::to(['blog/add-comment', 'id' => $model['article']['id']])
]); 
?>
	<h3><?=Yii::t('app', 'LEAVE A COMMENT')?></h3>
    <p>
    	<?=Yii::t('app', 'Tell everyone what You think about it.')?><br>
    	<?=Yii::t('app', 'Leave a comment so that other users know about it.')?>
    </p>
   	<div class="row">
   		<div class="col-md-6 col-xs-12 col-sm-6">
	<?= $form->field($comment, 'name')->textInput([
			    	'maxlength' => true,
			    	'placeholder' => Yii::t('app', 'Your Name'),
	])->label(false) ?>
	</div>
		<div class="col-md-6 col-xs-12 col-sm-6">
	<?= $form->field($comment, 'email')->textInput([
			    	'maxlength' => true,
			    	'placeholder' => Yii::t('app', 'Your Email'),
	])->label(false) ?>
    </div>
	</div>
	<?= $form->field($comment, 'text')->textInput([
    	'maxlength' => true,
    	'placeholder' => Yii::t('app', 'Message'),
    ])->label(false) ?>

    <input type="submit" id="submit-comment" value="<?=Yii::t('app', 'LEAVE THE COMMENT')?>">

<?php ActiveForm::end(); ?>
</div>
<hr>
<a name="comments"></a>
<?php foreach ($model['comments'] as $comment): ?>
<div class="bubble">
	<blockquote>
		<p><?=$comment['text']?></p>
	</blockquote>
	<cite><strong><?=$comment['name']?></strong> on <?=$comment['pub_date_time']?></cite>
</div>
<hr>
<?php endforeach;?>
<div class="clearfix"> </div>