<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ticket}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%Screening}}`
 */
class m210703_091042_create_ticket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ticket}}', [
            'id' => $this->primaryKey(),
            'screening_id' => $this->integer()->notNull(),
            'seat' => $this->string(10)->notNull(),
            'name' => $this->string(30)->notNull(),
            'phone_num' => $this->string(30)->notNull(),
            'email' => $this->string(30)->notNull()
        ]);

        // creates index for column `screening_id`
        $this->createIndex(
            '{{%idx-ticket-screening_id}}',
            '{{%ticket}}',
            'screening_id'
        );

        // add foreign key for table `{{%Screening}}`
        $this->addForeignKey(
            '{{%fk-ticket-screening_id}}',
            '{{%ticket}}',
            'screening_id',
            '{{%Screening}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%Screening}}`
        $this->dropForeignKey(
            '{{%fk-ticket-screening_id}}',
            '{{%ticket}}'
        );

        // drops index for column `screening_id`
        $this->dropIndex(
            '{{%idx-ticket-screening_id}}',
            '{{%ticket}}'
        );

        $this->dropTable('{{%ticket}}');
    }
}
