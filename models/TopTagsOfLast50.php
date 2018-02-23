<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "popular_tags".
 *
 * @property int $tag_id
 * @property string $tag_title
 * @property string $total_views
 */
class TopTagsOfLast50 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'popular_tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_id'], 'integer'],
            [['tag_title'], 'required'],
            [['total_views'], 'number'],
            [['tag_title'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tag_id' => 'Tag ID',
            'tag_title' => 'Tag Title',
            'total_views' => 'Total Views',
        ];
    }
}
