<?php

namespace app\components\PopularTags;
use Yii;
use yii\base\Widget;
use app\models\TopTagsOfLast50;
use yii\helpers\Url;
class PopularTags extends Widget{

	public function init()
    {
        parent::init();
    }

	public function run()
	{
		// Пробуем извлечь $data из кэша.
		$data = Yii::$app->cache->get('popularTags');
		
		/**
		* В параметрах есть блок настроек главной страницы,
		* в том числе кол-во выводимых тегов.
		*/
		$params = Yii::$app->params['mainPageRules']['popularTags'];
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
		$tags = TopTagsOfLast50::find()->limit($max)->all();

		$html = '<ul class="popular-tag">';

		//Формируем ul>li>a[href="blog/teg?{id}"] #Название_тега
		foreach ($tags as $tag) {
			ob_start();
			include '/template.php';
			$html .= ob_get_clean();
		}

		$html .= '</ul>';

		//Записываем в кеш
		Yii::$app->cache->set('popularTags', $html, $cacheTime);
		return $html;
	}

}