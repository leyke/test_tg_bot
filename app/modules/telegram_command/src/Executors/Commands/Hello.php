<?php

namespace app\modules\telegram_command\src\Executors\Commands;

use app\modules\core\src\Helpers\UtilsHelper;
use app\modules\telegram_command\src\Executors\BaseExecutor;
use app\modules\telegram_command\src\Executors\ExecuteInterface;
use Exception;
use yii\helpers\ArrayHelper;

class Hello extends BaseExecutor implements ExecuteInterface
{
    /**
     * @throws Exception
     */
    function execute(array $update): bool
    {
        $chatId = $this->getChatId($update);

        $answer = UtilsHelper::outputFormat('Привет, {name}! Хорошего дня!', [
            'name' => ArrayHelper::getValue($update, 'message.from.firstName'),
        ]);

        if ($this->answer($chatId, ['message' => $answer])) {
            return true;
        }

        return false;
    }
}