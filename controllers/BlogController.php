<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Article;
use app\models\Category;
use app\models\Tag;
use yii\helpers\Url;
use yii\helpers\Html;

class BlogController extends Controller
{
    public function init()
    {
        $session = Yii::$app->session;
        if(isset($session['language'])){
            Yii::$app->language = $session['language'];
        }

    }
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionLanguage($lang)
    {
        

        $langs = Yii::$app->params['languages'];
        if( in_array($lang, $langs) ){
            $session = Yii::$app->session;
            $session['language'] = $lang;
        }
        
        if(Yii::$app->user->returnUrl != '/') 
            return $this->goBack();
        else return Yii::$app->request->referrer ? 
                    $this->redirect(Yii::$app->request->referrer) : $this->goHome();
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
    	$model['title'] = Yii::t('app', 'New articles');
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
        $this->view->params['subTitle'] = Yii::t('app', 'ALL IN CATEGORY').' "'.$category['title'].'"';
        $model['title'] = Yii::t('app', $category['title']);
        //Получаем статьи
        $model['articles'] = $category->getArticles()
                                    ->orderBy(['pub_date' => SORT_DESC])
                                    ->all();

        //Передаем в представление все статьи с данной категорией
        return $this->render('index', compact('model'));
    }

    public function actionTag($id = null)
    {
        //Если нет параметра, выводим все
        if($id == null){
            $tags = Tag::find()->with('articles')->all();

            //Заголовок контентной части в layout
            $this->view->params['subTitle'] = Yii::t('app', 'ALL TAGS');
            
            //Передаем в представление все статьи с данным тегом
            $model['tags'] = $tags;
            return $this->render('tags', compact('model'));
        }



        //Получаем тег
        $tag = Tag::findOne($id);

        //Заголовок контентной части в layout и заголовок вкладки
        $this->view->params['subTitle'] = Yii::t('app', 'ALL BY TAG').' #'.$tag['title'];
        $model['title'] = '#'.$tag['title'].' - SmileBlog.ru';

        //Передаем в представление все статьи с данным тегом
        $model['articles'] = $tag->articles;
        return $this->render('index', compact('model'));
    }

    

    public function actionSearch($pattern = null)
    {   
        if($pattern == null){
            Yii::$app->response->redirect(Url::to('index'));
        }

        $pattern = Html::encode($pattern);
        $title = Yii::t('app', 'Search result: "{pattern}"');
        $this->view->params['subTitle'] = str_replace("{pattern}", $pattern, $title);

        
        $pattern = '%'.$pattern.'%';
        
        $model['result']['articles'] = Article::find()
                                    ->where(
                                        [
                                            'OR',
                                            ['like', 'title', $pattern, false],
                                            ['like', 'text', $pattern, false]
                                        ])
                                    ->orderby(['pub_date'=>SORT_DESC])                          
                                    ->with('category')
                                    ->with('tags')
                                    ->all();
        
        $model['result']['tags'] = Tag::find()
                                    ->where(['like', 'title', $pattern, false])
                                    ->with('articles')
                                    ->all();
        
        $model['result']['categories'] = Category::find()
                                    ->where(['like', 'title', $pattern, false])                     
                                    ->with('articles')
                                    ->all();

        return $this->render('search', compact('model'));
    }

}
