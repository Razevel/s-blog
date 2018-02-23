<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Article;
use app\models\Category;
class BlogController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
    	/**
		* В параметрах есть блок настроек главной страницы,
		* в том числе кол-во новых записей.
		*/
    	$max = Yii::$app->params['mainPageRules']['aticlesCount'];
        
        $model['articles'] = Article::find()
        							->limit($max)
        							->orderby(['pub_date'=>SORT_DESC])
        							->all();

        return $this->render('index', compact('model'));
    }
}
