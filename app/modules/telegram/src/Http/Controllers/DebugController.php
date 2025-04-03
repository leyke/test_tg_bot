<?php

namespace app\modules\telegram\src\Http\Controllers;

use app\modules\core\src\Controllers\BaseRestController;
use app\modules\telegram\src\GetBotInfo\GetBotInfoInterface;
use yii\web\Response;

class DebugController extends BaseRestController
{
    public function actionBotInfo(GetBotInfoInterface $getBotInfo): Response
    {
        return $this->asJson(['status' => 'ok', 'data' => $getBotInfo->getResponse()]);
    }
}