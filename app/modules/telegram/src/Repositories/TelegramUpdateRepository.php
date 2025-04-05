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
            ->andWhere(['is_processed' => 0])
            ->orderBy(['created_at' => SORT_DESC])
            ->scalar();
    }
}