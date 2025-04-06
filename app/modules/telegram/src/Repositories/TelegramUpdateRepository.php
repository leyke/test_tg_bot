<?php

namespace app\modules\telegram\src\Repositories;

use app\modules\core\src\Repositories\BaseRepository;
use app\modules\telegram\src\Models\TelegramUpdate;

class TelegramUpdateRepository extends BaseRepository implements TelegramUpdateRepositoryInterface
{
    public string $queryClass = TelegramUpdate::class;

    public function getLastUpdate(): int
    {
        return $this->find()
            ->select('update_id')
            ->orderBy(['created_at' => SORT_DESC])
            ->scalar();
    }

    public function getUnprocessedUpdates(): array
    {
        return $this->find()
            ->andWhere(['is_processed' => TelegramUpdate::IS_UNPROCESSED])
            ->orderBy(['update_id' => SORT_ASC])
            ->all();
    }
}