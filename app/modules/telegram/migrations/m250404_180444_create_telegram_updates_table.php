<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%telegram_updates}}`.
 */
class m250404_180444_create_telegram_updates_table extends Migration
{
    const TABLE = '{{%telegram_updates}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(static::TABLE, [
            'id' => $this->primaryKey(),
            'update_id' => $this->integer()->notNull(),
            'update' => $this->json()->null(),
            'is_processed' => $this->tinyInteger()->notNull()->defaultValue(0),
            'created_at' => $this->bigInteger()->null(),
        ]);

        $this->createIndex('tu_update_id', static::TABLE, 'update_id');
        $this->createIndex('is_processed', static::TABLE, 'is_processed');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(static::TABLE);
    }
}
