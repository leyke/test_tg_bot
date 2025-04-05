<?php

namespace app\modules\telegram\src\Console\Controllers;

use app\modules\telegram\src\GetUpdates\GetUpdatesFromTelegramInterface;
use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class ProcessController extends Controller
{
    public function actionExecuteUpdates(): int
    {
        Yii::info(__METHOD__ . 'Done', 'telegram');
        return ExitCode::OK;

    }

    public function actionGetUpdates(GetUpdatesFromTelegramInterface $getUpdates): int
    {
        $result = $getUpdates->loop();

        Yii::info(__METHOD__ . 'Done', 'telegram');
        return $result ? ExitCode::OK : ExitCode::UNSPECIFIED_ERROR;
    }
}