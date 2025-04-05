<?php

namespace app\modules\telegram\src\GetUpdates;

interface GetUpdatesFromTelegramInterface
{
    public function execute(): void;
    public function loop(): bool;
}