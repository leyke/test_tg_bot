<?php

namespace app\modules\telegram_command\src\Executors\Commands;

use app\modules\telegram_command\src\Enums\CommandsEnum;
use app\modules\telegram_command\src\Executors\BaseExecutor;
use app\modules\telegram_command\src\Executors\ExecuteInterface;
use Exception;
use Vjik\TelegramBot\Api\Type\InlineKeyboardButton;
use Vjik\TelegramBot\Api\Type\InlineKeyboardMarkup;
use Vjik\TelegramBot\Api\Type\InputFile;
use Vjik\TelegramBot\Api\Type\KeyboardButton;
use Vjik\TelegramBot\Api\Type\ReplyKeyboardMarkup;
use Yii;
use yii\helpers\Url;

class MenuButton extends BaseExecutor implements ExecuteInterface
{
    const CAT_IMG = '@app/web/img/static/cat_img.jpg';
    const DOG_IMG = '@app/web/img/static/dog_img.jpeg';

    public ?CommandsEnum $command = null;

    public function setCommand($command): self
    {
        $this->command = $command;
        return $this;
    }

    /**
     * @throws Exception
     */
    public function execute(array $update): bool
    {
        $chatId = $this->getChatId($update);
        $path = $this->command?->isDog() ? self::DOG_IMG : self::CAT_IMG;

        $inputFile = InputFile::fromLocalFile(Yii::getAlias($path));
        $keyboard = $this->createKeyboard();
        $data = [
            'photo' => $inputFile,
            'keyboard' => $keyboard
        ];

        return $this->answer($chatId, $data);
    }

    private function createKeyboard(): InlineKeyboardMarkup
    {
        $buttons = [];

        if ($this->command->isDog()) {
            $buttons[] = [new InlineKeyboardButton(
                text: 'Хочу еще кота',
                callbackData: 'show-cat'
            )];
        } else {
            $buttons[] = [new InlineKeyboardButton(
                text: 'Хочу еще собаку',
                callbackData: 'show-dog'
            )];
        }

        return new InlineKeyboardMarkup($buttons);
    }

    protected function answer($chatId, $data): bool
    {
        return $this->service->sendPhoto($chatId, $data);
    }
}