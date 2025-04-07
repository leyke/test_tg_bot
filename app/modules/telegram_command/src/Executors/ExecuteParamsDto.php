<?php

namespace app\modules\telegram_command\src\Executors;

use app\modules\core\src\Dto\BaseDto;
use Vjik\TelegramBot\Api\Type\Update\Update;

class ExecuteParamsDto extends BaseDto
{
    public int $chatId;
    public ?string $message = null;
    public Update $update;
}