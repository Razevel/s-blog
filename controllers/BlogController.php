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
        //Заголовок контентной части в layout
        $this->view->params['subTitle'] = Yii::t('app', 'NEW ARTICLES');
    	
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

    public function actionArticle()
    {
        //Заголовок контентной части в layout
        $this->view->params['subTitle'] = '';
       
        
        $model['article'] = Article::find()->one();

        return $this->render('article', compact('model'));
    }

}
