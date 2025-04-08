<?php

namespace app\modules\telegram_command\src\Enums;

enum CommandsEnum: string
{
    case Start = '/start';

    case Hello = '/hello';
    case Menu = '/menu';
    case Close = '/close';

    case Dog = 'Покажи собаку';
    case Cat = 'Покажи кота';

    public function isDog(): bool
    {
        return $this === self::Dog;
    }
}
