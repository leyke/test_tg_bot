<?php

namespace app\modules\core\src\LoopExecute;

use Carbon\Carbon;
use Exception;
use Yii;

abstract class BaseLoopService implements LoopExecuteInterface
{
    // Время жизни процесса в минутах
    const MAX_TIME_TO_EXECUTE = 24 * 60;
    const TIMEOUT = 30;
    const DELAY = 1;

    public function loop(): bool
    {
        try {
            $timeToEnd = Carbon::now()->addMinutes(self::MAX_TIME_TO_EXECUTE);
            while (Carbon::now()->lessThan($timeToEnd)) {
                $this->execute();

                $this->delay();
            }

            return true;
        } catch (Exception $exception) {
            Yii::error(__METHOD__ . ' ' . $exception->__toString(), 'telegram');
            return false;
        }
    }

    abstract public function execute(): void;

    private function delay(): void
    {
        usleep(self::DELAY);
    }
}