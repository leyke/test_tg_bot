<?php
$params = [];

$params['appUrl'] = env('APP_URL');
$params['appTelegramPort'] = env('APP_TELEGRAM_PORT');

$params['corsOrigin'] = !empty(env('CORS_ALLOW_ORIGIN')) ? explode(',', env('CORS_ALLOW_ORIGIN')) : [];

$params['tgBotToken'] = env('TG_BOT_TOKEN');

return $params;
