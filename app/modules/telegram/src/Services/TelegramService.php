<?php

namespace app\modules\telegram\src\Services;

use Telegram\Bot\Api;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Objects\User;
use Yii;
use yii\base\Component;

class TelegramService extends Component
{
    private Api $service;

    /**
     * @throws TelegramSDKException
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        $this->service = new Api(Yii::$app->params['tgBotToken']);
    }

    /**
     * @throws TelegramSDKException
     */
    public function me(): User
    {
        return $this->service->getMe();
    }
}