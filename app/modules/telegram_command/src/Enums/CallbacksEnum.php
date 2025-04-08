<?php

namespace app\modules\telegram_command\src\Enums;

enum CallbacksEnum: string
{
    case DogQuery = 'show-dog';
    case CatQuery = 'show-cat';

    public function isCat()
    {
        return $this === self::CatQuery;
    }
}
