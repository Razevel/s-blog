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
		$data = Yii::$app->cache->get('popularTags');

		if ($data !== false) {
		    // $data в кэше, возвращаем
		    return $data;
		}
		
		$tags = TopTagsOfLast50::find()->all();
		$html = '<ul class="popular-tag">';
		foreach($tags as $tag) 
		{			
			$html .= sprintf(
				'<li><a href="%s">%s</a></li>', 
				Url::to(['blog/tag', 'id' => $tag['tag_id']]), 
				$tag['tag_title']
			);
		}

		$html .= '</ul>';
		Yii::$app->cache->set('popularTags', $html, 15*60);
		return $html;
	}

}