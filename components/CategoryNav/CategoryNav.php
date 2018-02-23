<?php

namespace app\components\CategoryNav;
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
		$this->data = Category::find()->indexBy('id')->asArray()->all();
		$this->tree = $this->getTree();
		$this->menuHtml = $this->getMenuHtml($this->tree);
		return sprintf('<ul class="cd-accordion-menu animated">%s</ul>', $this->menuHtml) ;
	}

	protected function getTree($value='')
	{
		$tree = [];
		foreach ($this->data as $id => &$node) {
			if(!$node['parent_id'])
				$tree[$id] = &$node;
			else
				$this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
		}
		return $tree;
	}

	protected function getMenuHtml($tree)	
	{
		$str = '';
		foreach ($tree as $category) {
			$str .= $this->catToTemplate($category);
		}
		return $str;
	}

	protected function catToTemplate($category)	
	{
		ob_start();
		include __DIR__.'/template.php';
		return ob_get_clean();
	}


}