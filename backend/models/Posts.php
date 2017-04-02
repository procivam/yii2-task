<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $anounce
 * @property integer $published
 * @property string $published_at
 * @property integer $category_id
 * @property string $tags
 *
 * @property Categories $category
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['slug'], 'required'],
            [['description', 'tags'], 'string'],
            [['published', 'category_id'], 'integer'],
            [['published_at'], 'safe'],
            [['name', 'slug', 'anounce'], 'string', 'max' => 255],
            [['slug'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'slug' => 'URL алиас',
            'description' => 'Описание',
            'anounce' => 'Анонс',
            'published' => 'Опубликовано',
            'published_at' => 'Дата публикации',
            'category_id' => 'Категория',
            'tags' => 'Теги',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }
}
