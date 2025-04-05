<?php

namespace app\modules\core\src\Dto;

use yii\base\BaseObject;

class BaseDto extends BaseObject
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}