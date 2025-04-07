<?php

namespace app\modules\telegram_command\src\Executors;


interface ExecuteInterface
{
    public function execute(array $update): bool;
}