<?php

use yii\db\Migration;

/**
 * Handles the creation of table `posts`.
 */
class m170402_191026_create_posts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'slug' => $this->string()->notNull()->unique(),
            'description' => $this->text(),
            'anounce' => $this->string(),
            'published' => $this->boolean()->defaultValue(false),
            'published_at' => $this->dateTime()->defaultValue(null),
            'category_id' => $this->integer(),
            'tags' => $this->text(),
        ]);

        $this->createIndex(
            'idx-posts-slug',
            'posts',
            'slug'
        );

        $this->createIndex(
            'idx-posts-category_id',
            'posts',
            'category_id'
        );

        $this->addForeignKey(
            'fk-posts-category_id',
            'posts',
            'category_id',
            'categories',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-posts-category_id', 'posts');

        $this->dropIndex('idx-posts-category_id', 'posts');

        $this->dropTable('posts');
    }
}
