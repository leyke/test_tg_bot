<?php

namespace app\modules\telegram\src\Repositories;

interface TelegramUpdateRepositoryInterface
{
    public function getLastUpdate();
}