<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ArticleTags */

$this->title = 'Update Article Tags: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Article Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="article-tags-update">

   
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
