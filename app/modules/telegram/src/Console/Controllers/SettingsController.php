<?php

namespace app\modules\telegram\src\Console\Controllers;

use app\modules\telegram\src\SetWebhook\SetWebhookForTelegramInterface;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

class SettingsController extends Controller
{
    public function actionSetWebhook(SetWebhookForTelegramInterface $setWebhook)
    {
        $result = $setWebhook->execute();
        Console::output($result ? 'OK!' : 'ERROR!');

        return ExitCode::OK;
    }
}