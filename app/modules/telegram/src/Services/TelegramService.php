<?php

namespace app\modules\telegram\src\Services;

use app\modules\core\src\Interfaces\BotServiceInterface;
use app\modules\telegram\src\ExtendedApiMethods\SendReplyKeyboard;
use Exception;
use Vjik\TelegramBot\Api\FailResult;
use Vjik\TelegramBot\Api\Method\SendMessage;
use Vjik\TelegramBot\Api\TelegramBotApi;
use Vjik\TelegramBot\Api\Transport\Curl\CurlTransport;
use Vjik\TelegramBot\Api\Type\InputFile;
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
        $response = $this->api->getUpdates($offset, null, $timeout, ['message']);

        if ($response instanceof FailResult) {
            $this->errorLog($response);
            return [];
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

    /**
     * @throws Exception
     */
    public function sendMsg(int $chatId, array $data = []): bool
    {
        $msg = ArrayHelper::getValue($data, 'message');

        $response = $this->api->sendMessage($chatId, $msg);

        if ($response instanceof FailResult) {
            $this->errorLog($response);
            return false;
        }

        return true;
    }

    public function replyKeyboard($chatId, $keyboard): bool
    {
        $response = $this->api->sendMessage(
            chatId: $chatId,
            text: 'Отображаю меню',
            replyMarkup: $keyboard
        );

        if ($response instanceof FailResult) {
            $this->errorLog($response);
            return false;
        }

        return true;
    }

    /**
     * @throws Exception
     */
    public function sendPhoto(int $chatId, array $data): bool
    {
        $response = $this->api->sendPhoto(
            chatId: $chatId,
            photo: ArrayHelper::getValue($data, 'photo'),
            replyMarkup: ArrayHelper::getValue($data, 'keyboard')
        );

        if ($response instanceof FailResult) {
            $this->errorLog($response);
            return false;
        }

        return true;
    }

    private function errorLog(FailResult $error): void
    {
        Yii::error(ArrayHelper::toArray($error), 'telegram');
    }

}