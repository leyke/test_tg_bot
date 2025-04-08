<?php

namespace app\modules\telegram_command\src\Executors\Commands;

use app\modules\telegram_command\src\Executors\BaseExecutor;
use app\modules\telegram_command\src\Executors\ExecuteInterface;

class Close extends BaseExecutor implements ExecuteInterface
{
    function execute(array $update): bool
    {
        return true;
    }
}