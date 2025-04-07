<?php

namespace app\modules\telegram_command\src\Executors\Commands;

use app\modules\telegram_command\src\Enums\CommandsEnum;
use app\modules\telegram_command\src\Executors\ExecuteInterface;
use Yii;
use yii\base\InvalidConfigException;

class CommandFactory
{
    /**
     * @throws InvalidConfigException
     */
    public static function createExecutor(?CommandsEnum $command): ExecuteInterface
    {
        return match ($command) {
            CommandsEnum::HELLO => Yii::createObject(Hello::class),
            CommandsEnum::MENU => Yii::createObject(Menu::class),
            CommandsEnum::CLOSE => Yii::createObject(Close::class),
            default => Yii::createObject(CopyUserMessage::class)
        };
    }
}