<?php
use app\components\CategoryNav\CategoryNav;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\helpers\Html;
?>

<table>
	<thead>
		<tr>
			<th>Название</th>
			<th>Просмотры</th>
			<th>Автор</th>
			<th>Дата</th>
			<th>Перейти</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($articles as $article): ?>
	<tr>
		<td><?=$article['title']?></td>
		<td><?=$article['views']?></td>
		<td>admin</td>
		<td><?=$article['pub_date']?></td>
		<td>url</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
</table>