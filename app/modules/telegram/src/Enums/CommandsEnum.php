<?php

namespace app\modules\telegram\src\Enums;

enum CommandsEnum: string
{
    case HELLO = '/hello';
    case MENU = '/menu';
}
