<?php

namespace app\components;
use yii\base\Widget;
use app\models\Category;
class CategoryNav extends Widget{


	

	public function init($template = null)
    {
        parent::init();
    }

	public function run()
	{
		
		return sprintf('Cats') ;
	}


}