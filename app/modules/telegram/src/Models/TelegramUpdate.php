<?php

namespace app\modules\telegram\src\Models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "telegram_updates".
 *
 * @property int $id
 * @property int $update_id
 * @property array|null $update
 * @property int $is_processed
 * @property int|null $created_at
 */
class TelegramUpdate extends ActiveRecord
{
    const IS_PROCESSED = 1;
    const IS_UNPROCESSED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telegram_updates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['update', 'created_at'], 'default', 'value' => null],
            [['is_processed'], 'default', 'value' => 0],
            [['update_id'], 'required'],
            [['update_id', 'is_processed', 'created_at'], 'integer'],
            [['update'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'update_id' => 'Update ID',
            'update' => 'Update',
            'is_processed' => 'Is Processed',
            'created_at' => 'Created At',
        ];
    }

}
