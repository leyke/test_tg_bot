<?php

namespace app\modules\telegram\src\GetUpdates;

use app\modules\core\src\Dto\BaseDto;

class TelegramUpdateSaveDto extends BaseDto
{
    public int $update_id;
    public string $update;
    public int $created_at;
}