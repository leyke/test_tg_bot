<?php

namespace app\modules\core\src\Repositories;


use app\modules\core\src\Interfaces\RepositoryInterface;
use yii\db\ActiveQuery;

class BaseRepository implements RepositoryInterface
{
    public string $queryClass;

    public function find(): ActiveQuery
    {
        return call_user_func([$this->queryClass, 'find']);
    }
}