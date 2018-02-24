<?php

namespace app\components\PopularArticles;
use Yii;
use yii\base\Widget;
use app\models\Article;
use yii\helpers\Url;

class PopularArticles extends Widget{

	public function init()
    {
        parent::init();
    }

	public function run()
	{
		// Пробуем извлечь $data из кэша.
		$data = Yii::$app->cache->get('popularArticles');
		
		/**
		* В параметрах есть блок настроек главной страницы,
		* в том числе кол-во выводимых тегов.
		*/
		$params = Yii::$app->params['popularArticles'];
		$max = $params['count'];
        $cacheTime = $params['cacheTime'];

        //Если в кэше что то было - возвращаем
		if ($cacheTime > 0 && $data !== false) {
		    return $data;
		}
		
		/**
		 * Получаем список тегов с наибольшим суммарным
		 * количеством просмотров по последним 50ти добавленным
		 * записям.
		 */	
		$articles = Article::find()
						->orderby(['views'=>SORT_DESC])
						->limit($max)
						->all();


		$html = '<ul class="popular">';

		//Формируем ul>li>a[href="blog/article?{id}"] #Название_тега
		foreach ($articles as $article) {
			ob_start();
			include '/template.php';
			$html .= ob_get_clean();
		}

		$html .= '</ul>';
		
		//Записываем в кеш
		Yii::$app->cache->set('popularArticles', $html, $cacheTime);
		return $html;
	}

}