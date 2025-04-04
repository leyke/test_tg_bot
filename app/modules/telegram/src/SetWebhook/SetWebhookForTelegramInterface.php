<?php

namespace app\modules\telegram\src\SetWebhook;

interface SetWebhookForTelegramInterface
{
    public function execute(): bool;
}