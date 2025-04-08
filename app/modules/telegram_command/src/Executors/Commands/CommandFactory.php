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
            CommandsEnum::Hello => Yii::createObject(Hello::class),
            CommandsEnum::Menu => Yii::createObject(Menu::class),
            CommandsEnum::Close => Yii::createObject(Close::class),
            CommandsEnum::Cat, CommandsEnum::Dog => Yii::createObject(MenuButton::class)->setCommand($command),
            default => Yii::createObject(CopyUserMessage::class)
        };
    }
}