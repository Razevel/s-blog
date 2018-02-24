<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Article;
use app\models\Category;
use app\models\Tag;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\data\Pagination;

class BlogController extends Controller
{
    public function init()
    {
        //Если в сессии уже установлен язык, то достаем и применяем
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


    /**
     * Смена языка
     *
     */
    public function actionLanguage($lang)
    {
        //Получаем все доступные языки
        $langs = Yii::$app->params['languages'];

        /**Проверяем, является ли параметр доступным языком,
         * если да, то сохраняем в сессию
         */
        if( in_array($lang, $langs) ){
            $session = Yii::$app->session;
            $session['language'] = $lang;
        }
        
        // Отправляем пользователя туда откуда пришел,
        // если конечно не с гугла, тогда на главную
        if(Yii::$app->user->returnUrl != '/') 
            return $this->goBack();
        else return Yii::$app->request->referrer ? 
                    $this->redirect(Yii::$app->request->referrer) : $this->goHome();
    }


    /**
     * Displays homepage.
     * Несколько самых свежих статей
     */
    public function actionIndex()
    {
        //Заголовок контентной части в layout
        $this->view->params['subTitle'] = Yii::t('app', 'NEW ARTICLES');
        
        //Заголовок вкладки браузера
    	$model['title'] = Yii::t('app', 'New articles');    	


        //Получаем самые свежие записи.
        $query = Article::find()
                        ->orderby(['pub_date'=>SORT_DESC])							
                        ->with('category')
                        ->with('tags');

        //Создаем пагинатор
        $pages = $this->getPagination(Yii::$app->params['indexMaxArticles']);

        //Получаем данные в соответствии с текущей страницей.
        $model['articles'] = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        //Рендерим
        return $this->render('index', compact('model', 'pages'));
    }


    /**
    * Выводит статью 
    *
    */
    public function actionArticle($id)
    {
        //Заголовок контентной части в layout
        $this->view->params['subTitle'] = '';
        
        //Передаем в представление статью
        $model['article'] = Article::findOne($id);
        return $this->render('article', compact('model'));
    }


    /**
    * Выводит все статьи из указанной категории
    *
    */
    public function actionCategory($id)
    {
        //Заголовок контентной части в layout
        $this->view->params['subTitle'] = Yii::t('app', 'ALL IN CATEGORY').' "'.$category['title'].'"';
        
        //Заголовок вкладки браузера
        $model['title'] = Yii::t('app', $category['title']);
        
        //Получаем все статьи данной категории
        $category = Category::findOne($id);
        $query = $category->getArticles()->orderBy(['pub_date' => SORT_DESC]);
        
        //Создаем пагинатор
        $pages = $this->getPagination($query->count());

        //Получаем данные в соответствии с текущей страницей.
        $model['articles'] = $query->offset($pages->offset)->limit($pages->limit)->all();

        //Передаем в представление все статьи с данной категорией
        return $this->render('index', compact('model', 'pages'));
    }


    /**
    * Если без параметра, то выводит все теги
    * Если с параметром, все статьи по этому тегу
    */
    public function actionTag($id = null)
    {
        //Если не пришел параметр, выводим все теги
        if($id == null){
            
            //Заголовок контентной части в layout
            $this->view->params['subTitle'] = Yii::t('app', 'ALL TAGS');
            
            //Достаем все
            $tags = Tag::find()->with('articles')->all();

            //Передаем в представление все теги
            $model['tags'] = $tags;
            return $this->render('tags', compact('model'));
        }

        //Получаем тег
        $tag = Tag::findOne($id);

        //Заголовок контентной части в layout
        $this->view->params['subTitle'] = Yii::t('app', 'ALL BY TAG').' #'.$tag['title'];
        
        //Заголовок вкладки браузера
        $model['title'] = '#'.$tag['title'];

        //Получаем статьи с данным тегом
        $query = $tag->getArticles()->orderBy(['pub_date' => SORT_DESC]);
        
        //Создаем пагинатор
        $pages = $this->getPagination($query->count());

        //Получаем данные в соответствии с текущей страницей.
        $model['articles'] = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        //Передаем в представление все статьи с данной категорией
        return $this->render('index', compact('model', 'pages'));
    }


    /**
    * Выводит все статьи
    *
    */
    public function actionAllArticles()
    {
        //Заголовок контентной части в layout
        $this->view->params['subTitle'] = Yii::t('app', 'ALL ARTICLES');
        
        //Заголовок вкладки браузера
        $model['title'] = Yii::t('app', 'All articles');

        //Получаем все статьи
        $query = Article::find()->orderby(['pub_date'=>SORT_DESC])
                                ->with('category')
                                ->with('tags');

        //Создаем пагинатор
        $pages = $this->getPagination($query->count());

        //Получаем данные в соответствии с текущей страницей.
        $model['articles'] = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        //Передаем в представление все статьи
        return $this->render('index', compact('model', 'pages'));
    }


    /**
    * Ищет по всему сразу:
    *   -статьи
    *     - в заголовке
    *     - в тексте
    *     - в дате(строка YYYY-MM-DD)
    *   
    *   -теги в названии
    *   -категории в названии
    *
    */
    public function actionSearch($pattern = null)
    {   
        //нет запроса - нет ответа, до свидания.
        if($pattern == null){
            Yii::$app->response->redirect(Url::to('index'));
        }

        //Мало ли что
        $pattern = Html::encode($pattern);
        
        //Заголовок вкладки браузера
        $title = Yii::t('app', 'Search result: "{pattern}"');
        
        //Заголовок контентной части в layout
        $this->view->params['subTitle'] = str_replace("{pattern}", $pattern, $title);
        
        //то что будем вставлять в запрос WHERE LIKE %any%
        $pattern = '%'.$pattern.'%';
         
        //Получаем все записи, в тексте которых есть что-то похожее или совпадает дата
        //дата как строка - 2018-02-13
        $query = Article::find()->where(
                                    [
                                        'OR',
                                        ['like', 'title', $pattern, false],
                                        ['like', 'text', $pattern, false],
                                        ['like', 'pub_date', $pattern, false]
                                    ])
                                ->orderby(['pub_date'=>SORT_DESC])                          
                                ->with('category')
                                ->with('tags');

        //Создаем пагинатор
        $pages = $this->getPagination($query->count());
        
        //Получаем данные в соответствии с текущей страницей.
        $model['result']['articles'] = $query->offset($pages->offset)->limit($pages->limit)->all();
        
        //Получаем все теги, в тексте которых есть что-то похожее
        $model['result']['tags'] = Tag::find()
                                    ->where(['like', 'title', $pattern, false])
                                    ->with('articles')
                                    ->all();
        
        //Получаем все категории, в тексте которых есть что-то похожее
        $model['result']['categories'] = Category::find()
                                    ->where(['like', 'title', $pattern, false])                     
                                    ->with('articles')
                                    ->all();

        //Передаем в представление все результаты поиска
        return $this->render('search', compact('model', 'pages'));
    }
    

    /**
    * Создает и возвращает пагинатор
    *
    */ 
    protected function getPagination($max)
    {  
        //Получаем кол-во статей на каждой странице из app\config\params.php
        $pageSize = Yii::$app->params['pageSize'];

        // Создаем встроенный в Yii виджет пагинатора
        // Вот тут у меня не работает, я как не перебирал, все равно не получатся
        // чтобы при размере страницы = '2' выводилось максимум 3 записи
        // 2 на первой и 1 на второй. Он вытаскивает сразу 4  
        return new Pagination([
            'totalCount' => $max, 'pageSize' => $pageSize,
            'pageSizeParam' => false, 'forcePageParam' => false,
        ]);
    }
}
