<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Article Tags';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-tags-index">

    
    <p>
        <?= Html::a('Create Article Tags', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'article_id',
            'tag_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
