<?php

namespace app\modules\telegram\src\ExecuteUpdates;

use app\modules\core\src\LoopExecute\BaseLoopService;
use app\modules\telegram\src\Models\TelegramUpdate;
use app\modules\telegram\src\Repositories\TelegramUpdateRepositoryInterface;
use app\modules\telegram_command\src\Enums\CallbacksEnum;
use app\modules\telegram_command\src\Enums\CommandsEnum;
use app\modules\telegram_command\src\Executors\Commands\CommandFactory;
use Exception;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;

class ExecuteUpdatesFromTelegram extends BaseLoopService implements ExecuteUpdatesFromTelegramInterface
{

    public function __construct(
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
            if (!empty($telegramUpdate->update['message'])) {
                if ($this->answerToMessage($telegramUpdate->update)) {
                    $processedIds[] = $telegramUpdate->id;
                }
            }
            if (!empty($telegramUpdate->update['callbackQuery'])) {
                if ($this->answerToCallback($telegramUpdate->update)) {
                    $processedIds[] = $telegramUpdate->id;
                }
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
    private function answerToMessage(array $update): bool
    {
        $message = ArrayHelper::getValue($update, 'message.text');

        return CommandFactory::createExecutor(CommandsEnum::tryFrom($message))
            ->execute($update);
    }

    /**
     * @throws InvalidConfigException
     * @throws Exception
     */
    private function answerToCallback(?array $update): bool
    {
        $data = ArrayHelper::getValue($update, 'callbackQuery.data');

        return CommandFactory::createExecutorForCallback(CallbacksEnum::tryFrom($data))
            ->execute($update);
    }
}