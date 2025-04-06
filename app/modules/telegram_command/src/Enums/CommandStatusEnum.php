<?php

namespace app\modules\telegram_command\src\Enums;

enum CommandStatusEnum: int
{
    case CLOSED = 0;
    case NEW = 1;
    case EXECUTED = 2;
    case CONTINUED = 3;
}
