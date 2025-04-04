<?php

namespace app\modules\webhook\src\Http\Controllers;

use app\modules\core\src\Controllers\BaseRestController;
use Yii;
use yii\web\Response;

class TgController extends BaseRestController
{
    public function actionIndex(): Response
    {
        return $this->asJson(['status' => 'ok', 'msg' => 'Hello World!']);
    }

    public function actionCatch(): Response
    {
        return $this->asJson('ok');
    }
}