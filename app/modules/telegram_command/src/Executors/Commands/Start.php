<?php

namespace app\modules\telegram_command\src\Executors\Commands;

use app\modules\telegram_command\src\Executors\BaseExecutor;
use app\modules\telegram_command\src\Executors\ExecuteInterface;
use Exception;

class Start extends BaseExecutor implements ExecuteInterface
{
    /**
     * @throws Exception
     */
    function execute(array $update): bool
    {
        $chatId = $this->getChatId($update);
        $answer = 'Это тестовый тг бот начал работу';

        if ($this->answer($chatId, ['message' => $answer])) {
            return true;
        }

        return false;
    }
}