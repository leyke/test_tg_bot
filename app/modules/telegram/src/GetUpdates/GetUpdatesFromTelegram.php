<?php

namespace app\modules\telegram\src\GetUpdates;

use app\modules\core\src\Interfaces\BotServiceInterface;
use app\modules\core\src\LoopExecute\BaseLoopService;
use app\modules\telegram\src\Models\TelegramUpdate;
use app\modules\telegram\src\Repositories\TelegramUpdateRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Vjik\TelegramBot\Api\Type\Update\Update;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class GetUpdatesFromTelegram extends BaseLoopService implements GetUpdatesFromTelegramInterface
{
    const UPDATE_FIELD = 'updateId';

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
        $lastUpdateId = $this->repository->getLastUpdate();

        // Отступ должен быть на 1 больше последнего полученного id
        $offset = $lastUpdateId + 1;
        $updates = $this->service->getUpdates($offset, self::TIMEOUT);

        $dataToInsert = $this->getDataToInsert($updates);

        $this->insert($dataToInsert);
    }

    /**
     * @throws Exception
     */
    private function dto(array|Update $update): TelegramUpdateSaveDto
    {
        $dto = new TelegramUpdateSaveDto();
        $dto->update_id = ArrayHelper::getValue($update, self::UPDATE_FIELD);
        $dto->update = Json::encode($update);
        $dto->created_at = Carbon::now()->timestamp;

        return $dto;
    }

    /**
     * @param array $dataToInsert
     * @return void
     * @throws \yii\db\Exception
     */
    private function insert(array $dataToInsert): void
    {
        $db = TelegramUpdate::getDb();

        $db->createCommand()->batchInsert(
            TelegramUpdate::tableName(),
            ['update_id', 'update', 'created_at'],
            $dataToInsert
        )->execute();
    }

    /**
     * @param array $updates
     * @return array
     * @throws Exception
     */
    private function getDataToInsert(array $updates): array
    {
        $dataToInsert = [];

        foreach ($updates as $update) {
            $dataToInsert[] = $this->dto($update);
        }

        return $dataToInsert;
    }
}