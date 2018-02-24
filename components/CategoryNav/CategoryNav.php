<?php

namespace app\components\CategoryNav;
use Yii;
use yii\base\Widget;
use app\models\Category;
class CategoryNav extends Widget{


	private $data;
	private $tree;
	private $menuHtml;

	public function init()
    {
        parent::init();
    }

	public function run()
	{
		//Получаем параметр времени кеширования
		$params = Yii::$app->params['categoriesNav'];
		$cacheTime = $params['cacheTime'];


		// Пробуем извлечь $data из кэша.
		$data = Yii::$app->cache->get('categoryNav');
		if ($cacheTime > 0  && $data !== false) {
		    return $data;
		}

		//Получаем данные о всех категориях как массив
		$this->data = Category::find()->indexBy('id')->asArray()->all();
		$this->tree = $this->getTree();
		$this->menuHtml = $this->getMenuHtml($this->tree);
		$data = sprintf('<ul class="cd-accordion-menu animated">%s</ul>', $this->menuHtml);
		Yii::$app->cache->set('categoryNav', $data, $cacheTime);
		return $data;
	}

	// Формирует дерево категорий, вложенность не ограничена
	protected function getTree()
	{
		$tree = [];
		//Идем по массиву с категориями, по каждому узлу
		foreach ($this->data as $id => &$node) {
			
			//Если у узла нет родителя, то записываем в наше дерево на текущий индекс
			if(!$node['parent_id'])
				$tree[$id] = &$node;
			// Если у узла есть родитель, то:
			// в массиве $this->data находится его родитель
			// родителю задается массив детей(childs) и туда добавляется
			// ссылка на данный узел
			else
				$this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
		}
		
		return $tree;
	}

	//Формирует список категорий, вызывая для каждого метод получения разметки
	protected function getMenuHtml($tree)	
	{
		$str = '';
		foreach ($tree as $category) {
			$str .= $this->catToTemplate($category);
		}
		return $str;
	}


	/**
	 * Буферизирует шаблон списка категорий
	 * Шаблон, если находит пункт с дочерними категориями, вызывает  
	 * getMenuHtml(текущая категория), для рекурсивного обхода
     * @return String
     */
	protected function catToTemplate($category)	
	{
		ob_start();
		include '/template.php';
		return ob_get_clean();
	}


}