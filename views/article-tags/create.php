<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ArticleTags */

$this->title = 'Create Article Tags';
$this->params['breadcrumbs'][] = ['label' => 'Article Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-tags-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
