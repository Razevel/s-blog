<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Article;
use app\models\Category;
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
    	$max = Yii::$app->params['mainPageRules']['aticlesCount'];
        
        $model['articles'] = Article::find()
        							->limit($max)
        							->orderby(['pub_date'=>SORT_DESC])
        							->all();

        return $this->render('index', compact('model'));
    }

    public function actionArticle($id)
    {
        //Заголовок контентной части в layout
        $this->view->params['subTitle'] = '';
       
        
        
        $model['article'] = Article::findOne($id);
        return $this->render('article', compact('model'));
    }

    public function actionCategory($id)
    {
        //Заголовок контентной части в layout
        $category = Category::findOne($id);
        $this->view->params['subTitle'] =   sprintf("%s \"%s\"",
                                                Yii::t('app', 'ALL IN CATEGORY'),
                                                $category['title']
                                            );
        
        $model['articles'] = Article::find()
                                    ->where(['category_id' => $id])
                                    ->orderBy(['pub_date' => SORT_DESC])
                                    ->all();

        return $this->render('index', compact('model'));
    }

}
