<?php

namespace app\modules\telegram_command\src\Executors\Commands;

use app\modules\telegram_command\src\Executors\BaseExecutor;
use app\modules\telegram_command\src\Executors\ExecuteInterface;
use app\modules\telegram_command\src\Executors\ExecuteParamsDto;
use Vjik\TelegramBot\Api\Type\Update\Update;

class Close extends BaseExecutor implements ExecuteInterface
{
    function execute(array $update): bool
    {
        // TODO: Implement execute() method.
    }
}