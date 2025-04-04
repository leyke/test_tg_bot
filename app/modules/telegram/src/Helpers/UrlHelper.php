<?php

namespace app\modules\telegram\src\Helpers;

use app\modules\core\src\Helpers\UtilsHelper;
use Yii;

class UrlHelper
{
    public static function forWebhook(): string
    {
        return UtilsHelper::outputFormat('{appUrl}:{appTelegramPort}/{method}', [
            'appUrl' => Yii::$app->params['appUrl'],
            'appTelegramPort' => Yii::$app->params['appTelegramPort'],
            'method' => 'webhook/tg/catch',
        ]);
    }
}