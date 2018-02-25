<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;
/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property int $article_id
 * @property string $text
 * @property string $name
 * @property string $email
 * @property string $pub_date_time
 *
 * @property Articles $article
 */
class Comment extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'text', 'name', 'email'], 'required'],
            [['article_id'], 'integer'],
            [['pub_date_time'], 'safe'],
            [['text'], 'string', 'max' => 1000],
            [['name', 'email'], 'string', 'max' => 100],
            [['article_id'], 'exist', 'skipOnError' => true, 'targetClass' => Article::className(), 'targetAttribute' => ['article_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'text' => 'Text',
            'name' => 'Name',
            'email' => 'Email',
            'pub_date_time' => 'Pub Date Time',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }
}
