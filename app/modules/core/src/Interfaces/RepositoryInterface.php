<?php

namespace app\modules\core\src\Interfaces;

use yii\db\ActiveQuery;

interface RepositoryInterface
{
    public function find(): ActiveQuery;
}