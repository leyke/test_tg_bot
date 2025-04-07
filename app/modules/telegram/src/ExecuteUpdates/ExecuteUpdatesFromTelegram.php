<?php

namespace app\modules\telegram\src\ExecuteUpdates;

use app\modules\core\src\LoopExecute\BaseLoopService;
use app\modules\telegram\src\Models\TelegramUpdate;
use app\modules\telegram\src\Repositories\TelegramUpdateRepositoryInterface;
use app\modules\telegram_command\src\Enums\CommandsEnum;
use app\modules\telegram_command\src\Executors\Commands\CommandFactory;
use Exception;
use Vjik\TelegramBot\Api\Type\Update\Update;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\helpers\Json;

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
        $message = ArrayHelper::getValue($update, 'message.text');

        return CommandFactory::createExecutor(CommandsEnum::tryFrom($message))
            ->execute($update);
    }
}