<?php

namespace app\modules\telegram_command\src\Executors;


use app\modules\core\src\Interfaces\BotServiceInterface;
use Exception;
use yii\helpers\ArrayHelper;

abstract class BaseExecutor implements ExecuteInterface
{
    const BOT_ENTITY_TYPE = 'bot_command';

    public function __construct(
        protected readonly BotServiceInterface $service,
    )
    {
    }

    abstract function execute(array $update): bool;

    /**
     * @throws Exception
     */
    protected function answer($chatId, $data): bool
    {
        return $this->service->sendMsg($chatId, $data);
    }

    /**
     * @throws Exception
     */
    protected function getChatId(array $update): string
    {
        return ArrayHelper::getValue($update, 'message.chat.id');
    }
}