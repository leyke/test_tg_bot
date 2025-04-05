<?php

namespace app\modules\telegram\src\Services;

use app\modules\core\src\Interfaces\BotServiceInterface;
use Vjik\TelegramBot\Api\FailResult;
use Vjik\TelegramBot\Api\TelegramBotApi;
use Vjik\TelegramBot\Api\Transport\Curl\CurlTransport;
use Vjik\TelegramBot\Api\Type\Update\WebhookInfo;
use Vjik\TelegramBot\Api\Type\User;
use Yii;
use yii\base\Component;
use yii\helpers\ArrayHelper;

class TelegramService extends Component implements BotServiceInterface
{
    private TelegramBotApi $api;

    public function __construct($config = [])
    {
        parent::__construct($config);

        $transport = new CurlTransport();

        $this->api = new TelegramBotApi(Yii::$app->params['tgBotToken'], transport: $transport);
    }

    public function me(): User
    {
        $response = $this->api->getMe();

        if ($response instanceof FailResult) {
            $this->errorLog($response);
        }

        return $response;
    }

    public function getUpdates(int $offset = null, int $timeout = null): array
    {
        $response = $this->api->getUpdates($offset, null, $timeout);

        if ($response instanceof FailResult) {
            $this->errorLog($response);
        }

        return $response;
    }

    public function setWebhook(string $url): true
    {
        $response = $this->api->setWebhook($url);

        if ($response instanceof FailResult) {
            $this->errorLog($response);
        }

        return $response;
    }

    public function getWebhook(): WebhookInfo
    {
        $response = $this->api->getWebhookInfo();

        if ($response instanceof FailResult) {
            $this->errorLog($response);
        }

        return $response;
    }


    public function detachWebhook(): true
    {
        $response = $this->api->deleteWebhook();

        if ($response instanceof FailResult) {
            $this->errorLog($response);
        }

        return $response;
    }

    private function errorLog(FailResult $error): void
    {
        Yii::error(ArrayHelper::toArray($error), 'telegram');
    }

}