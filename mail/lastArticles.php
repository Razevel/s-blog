<?php
use app\components\CategoryNav\CategoryNav;
use yii\helpers\Url;
?>

<table>
	<thead>
		<tr>
			<th><?=Yii::t('app', 'Title')?></th>
			<th><?=Yii::t('app', 'Category')?></th>
			<th><?=Yii::t('app', 'Views')?></th>
			<th><?=Yii::t('app', 'Author')?></th>
			<th><?=Yii::t('app', 'Date')?></th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($articles as $article): ?>
	<tr>
		<td><?=$article['title']?></td>
		<td><?=$article['category']['title']?></td>
		<td><?=$article['views']?></td>
		<td>admin</td>
		<td><?=$article['pub_date']?></td>
		<td><a href="<?=Url::to(['blog/article', 'id' => $article['id']])?>"><?=Yii::t('app', 'View more')?></a></td>
	</tr>
	<?php endforeach; ?>
	</tbody>
</table>