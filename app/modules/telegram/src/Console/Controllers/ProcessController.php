<?php

namespace app\modules\telegram\src\Console\Controllers;

use app\modules\telegram\src\Services\TelegramService;
use yii\console\Controller;

class ProcessController extends Controller
{
    public function actionExecuteUpdates() {

    }

    public function actionGetUpdates()
    {
        $service = new TelegramService();
        return $this->asJson($service->getUpdates());
    }
}