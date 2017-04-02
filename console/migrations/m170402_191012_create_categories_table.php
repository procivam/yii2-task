<?php

use yii\db\Migration;

/**
 * Handles the creation of table `categories`.
 */
class m170402_191012_create_categories_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('categories', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'slug' => $this->string()->notNull()->unique(),
            'description' => $this->text(),
            'published' => $this->boolean()->defaultValue(false),
            'published_at' => $this->dateTime()->defaultValue(null),
        ]);

        $this->createIndex(
            'idx-categories-slug',
            'categories',
            'slug'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('idx-categories-slug', 'categories');

        $this->dropTable('categories');
    }
}
