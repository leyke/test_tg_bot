<?php

namespace app\modules\telegram_command\src\Executors\Commands;

use app\modules\core\src\Helpers\UtilsHelper;
use app\modules\telegram_command\src\Executors\BaseExecutor;
use app\modules\telegram_command\src\Executors\ExecuteInterface;
use Exception;
use Vjik\TelegramBot\Api\Type\Update\Update;
use yii\helpers\ArrayHelper;

class CopyUserMessage extends BaseExecutor implements ExecuteInterface
{

    /**
     * @throws Exception
     */
    function execute(array $update): bool
    {
        $chatId = $this->getChatId($update);
        $answer = UtilsHelper::outputFormat('Попугай говорит: {text}. (Команда не найдена, бот просто повторяет отправленный текст)', [
            'text' => ArrayHelper::getValue($update, 'message.text'),
        ]);

        if ($this->answer($chatId, ['message' => $answer])) {
            return true;
        }

        return false;
    }
}