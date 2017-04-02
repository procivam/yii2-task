<?php

use yii\db\Migration;

/**
 * Handles the creation of table `pages`.
 */
class m170402_191100_create_pages_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('pages', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'slug' => $this->string()->notNull()->unique(),
            'description' => $this->text(),
            'published' => $this->boolean()->defaultValue(false),
        ]);

        $this->createIndex(
            'idx-pages-slug',
            'pages',
            'slug'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropIndex('idx-pages-slug', 'pages');

        $this->dropTable('pages');
    }
}
