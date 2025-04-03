<?php
$params = [];

$params['corsOrigin'] = !empty(env('CORS_ALLOW_ORIGIN')) ? explode(',', env('CORS_ALLOW_ORIGIN')) : [];

$params['tgBotToken'] = env('TG_BOT_TOKEN');

return $params;
