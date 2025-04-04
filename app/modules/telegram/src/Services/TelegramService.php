<?php

namespace app\modules\telegram\src\Services;


use Vjik\TelegramBot\Api\FailResult;
use Vjik\TelegramBot\Api\TelegramBotApi;
use Vjik\TelegramBot\Api\Transport\Curl\CurlTransport;
use Vjik\TelegramBot\Api\Type\User;
use Yii;
use yii\base\Component;

class TelegramService extends Component
{
    private TelegramBotApi $api;

    public function __construct($config = [])
    {
        parent::__construct($config);
        $transport = new CurlTransport();

        $this->api = new TelegramBotApi(Yii::$app->params['tgBotToken'], transport: $transport);
    }

    public function me(): User|FailResult
    {
        return $this->api->getMe();
    }
}