<?php

namespace app\modules\telegram\src\ExecuteUpdates;

use app\modules\core\src\Interfaces\BotServiceInterface;
use app\modules\core\src\LoopExecute\BaseLoopService;
use app\modules\telegram\src\Models\TelegramUpdate;
use app\modules\telegram\src\Repositories\TelegramUpdateRepositoryInterface;
use app\modules\telegram_command\src\Enums\CommandsEnum;
use Exception;
use yii\helpers\ArrayHelper;

class ExecuteUpdatesFromTelegram extends BaseLoopService implements ExecuteUpdatesFromTelegramInterface
{
    public function __construct(
        private readonly BotServiceInterface               $service,
        private readonly TelegramUpdateRepositoryInterface $repository,
    )
    {
    }


    /**
     * @throws Exception
     */
    public function execute(): void
    {
        $log = $this->getUnprocessedUpdates();

        $processedIds = [];
        foreach ($log as $telegramUpdate) {
            if ($this->answerToUpdate($telegramUpdate->update)) {
                $processedIds[] = $telegramUpdate->id;
            }
        }

        TelegramUpdate::updateAll(['is_processed' => 1], ['is_processed' => 0, 'id' => $processedIds]);
    }

    /**
     * @return TelegramUpdate[]
     */
    private function getUnprocessedUpdates(): array
    {
        return $this->repository->getUnprocessedUpdates();
    }

    /**
     * @throws Exception
     */
    private function answerToUpdate(array $update): bool
    {
        $chatId = ArrayHelper::getValue($update, 'message.chat.id');
        $message = ArrayHelper::getValue($update, 'message.text');
        $type = ArrayHelper::getValue($update, 'message.entities.0.type');
        $command = CommandsEnum::tryFrom($message);

        if ($command && $type === 'bot_command') {
            $answer = 'Ну привет';
        } else {
            $answer = 'Попугай говорит: ' . $message;
        }

        if ($this->service->sendMsg($chatId, $answer)) {
            return true;
        }

        return false;
    }
}