<?php

namespace app\modules\telegram_command\src\Enums;

enum CommandsEnum: string
{
    case HELLO = '/hello';
    case MENU = '/menu';
    case CLOSE = '/close';
}
