<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\Category;


class Article extends ActiveRecord
{
  	public static function tableName()
    {
        return 'articles';
    }

    public function getCategory()
    {
       	return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}