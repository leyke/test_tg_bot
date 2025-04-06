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

    public function findOne(array $condition)
    {
        return call_user_func_array([$this->queryClass, 'findOne'], [$condition]);
    }

    public function findAll(array $condition)
    {
        return call_user_func_array([$this->queryClass, 'findOne'], [$condition]);
    }
}