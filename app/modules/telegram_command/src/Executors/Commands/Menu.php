<?php

namespace app\modules\telegram_command\src\Executors\Commands;

use app\modules\telegram_command\src\Enums\CommandsEnum;
use app\modules\telegram_command\src\Executors\BaseExecutor;
use app\modules\telegram_command\src\Executors\ExecuteInterface;
use Exception;
use Vjik\TelegramBot\Api\Type\KeyboardButton;
use Vjik\TelegramBot\Api\Type\ReplyKeyboardMarkup;

class Menu extends BaseExecutor implements ExecuteInterface
{
    /**
     * @throws Exception
     */
    public function execute(array $update): bool
    {
        $chatId = $this->getChatId($update);
        $keyboard = $this->createKeyboard();
        return $this->answer($chatId, $keyboard);
    }

    private function createKeyboard(): ReplyKeyboardMarkup
    {
        $buttons = [[new KeyboardButton(CommandsEnum::Dog->value), new KeyboardButton(CommandsEnum::Cat->value)]];

        return new ReplyKeyboardMarkup(
            keyboard: $buttons, oneTimeKeyboard: true);
    }

    protected function answer($chatId, $data): bool
    {
        return $this->service->replyKeyboard($chatId, $data);
    }
}