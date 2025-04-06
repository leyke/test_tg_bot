<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%telegram_command_exec}}`.
 */
class m250405_185431_create_telegram_command_exec_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%telegram_command_exec}}', [
            'id' => $this->primaryKey(),
            'update_id' => $this->integer()->notNull(),
            'message_id' => $this->integer()->notNull(),
            'chat_id' => $this->integer()->notNull(),
            'parent_id' => $this->integer()->null(),
            'message' => $this->integer()->null(),
            'query_data' => $this->json()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%telegram_command_exec}}');
    }
}
