<?php

namespace app\modules\telegram_command\src\Executors\Commands;

use app\modules\telegram_command\src\Enums\CallbacksEnum;
use app\modules\telegram_command\src\Executors\BaseExecutor;
use app\modules\telegram_command\src\Executors\ExecuteInterface;
use Exception;
use Vjik\TelegramBot\Api\Type\InputFile;
use Yii;
use yii\helpers\ArrayHelper;

class SendPhoto extends BaseExecutor implements ExecuteInterface
{
    const CAT_IMG = '@app/web/img/static/cat_img.jpg';
    const DOG_IMG = '@app/web/img/static/dog_img.jpeg';

    public ?CallbacksEnum $callback = null;

    public function setCallback($callback): self
    {
        $this->callback = $callback;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function execute(array $update): bool
    {
        $chatId = $this->getChatId($update);
        $path = $this->callback?->isCat() ? self::CAT_IMG : self::DOG_IMG;

        $inputFile = InputFile::fromLocalFile(Yii::getAlias($path));
        $data = [
            'photo' => $inputFile,
        ];

        return $this->answer($chatId, $data);
    }

    protected function getChatId(array $update): string
    {
        return ArrayHelper::getValue($update, 'callbackQuery.message.chat.id');
    }

    protected function answer($chatId, $data): bool
    {
        return $this->service->sendPhoto($chatId, $data);
    }
}