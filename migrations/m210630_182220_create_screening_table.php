<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%screening}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%movie}}`
 */
class m210630_182220_create_screening_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%screening}}', [
            'id' => $this->primaryKey(),
            'movie_id' => $this->string(10)->notNull(),
            'day' => $this->string()->notNull(),
            'start' => $this->string()->notNull(),
            'end' => $this->string()->notNull(),
            "price" => $this->integer()->notNull()
        ]);

        // creates index for column `movie_id`
        $this->createIndex(
            '{{%idx-screening-movie_id}}',
            '{{%screening}}',
            'movie_id'
        );

        // add foreign key for table `{{%movie}}`
        $this->addForeignKey(
            '{{%fk-screening-movie_id}}',
            '{{%screening}}',
            'movie_id',
            '{{%movie}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%movie}}`
        $this->dropForeignKey(
            '{{%fk-screening-movie_id}}',
            '{{%screening}}'
        );

        // drops index for column `movie_id`
        $this->dropIndex(
            '{{%idx-screening-movie_id}}',
            '{{%screening}}'
        );

        $this->dropTable('{{%screening}}');
    }
}
