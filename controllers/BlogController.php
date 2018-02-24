<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Article;
use app\models\Category;
use app\models\Tag;

class BlogController extends Controller
{

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

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
    	$max = Yii::$app->params['mainPageRules']['popularArticles']['count'];
        
        //Получаем N самых свежих записей.
        $model['articles'] = Article::find()
                                    ->orderby(['pub_date'=>SORT_DESC])
        							->limit($max)
                                    ->with('category')
                                    ->with('tags')
        							->all();

        return $this->render('index', compact('model'));
    }

    public function actionArticle($id)
    {
        //Заголовок контентной части в layout
        $this->view->params['subTitle'] = '';
       
        //Передаем в представление статью
        $model['article'] = Article::findOne($id);
        return $this->render('article', compact('model'));
    }

    public function actionCategory($id)
    {
        //Получаем категорию
        $category = Category::findOne($id);
        
        //Заголовок контентной части в layout
        $this->view->params['subTitle'] =   sprintf("%s \"%s\"",
                                                Yii::t('app', 'ALL IN CATEGORY'),
                                                $category['title']
                                            );
        //Получаем статьи
        $model['articles'] = $category->getArticles()
                                    ->orderBy(['pub_date' => SORT_DESC])
                                    ->all();

        //Передаем в представление все статьи с данной категорией
        return $this->render('index', compact('model'));
    }

    public function actionTag($id)
    {
        //Получаем тег
        $tag = Tag::findOne($id);

        //Заголовок контентной части в layout
        $this->view->params['subTitle'] = Yii::t('app', 'ALL BY TAG').' #'.$tag['title'];

        //Передаем в представление все статьи с данным тегом
        $model['articles'] = $tag->articles;
        return $this->render('index', compact('model'));
    }



}
