<?php

namespace app\modules\core\src\LoopExecute;

interface LoopExecuteInterface
{
    public function execute(): void;

    public function loop(): bool;
}