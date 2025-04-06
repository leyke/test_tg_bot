<?php
namespace app\modules\telegram_command\src;

use Yii;
use yii\base\BootstrapInterface;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public function bootstrap($app): void
    {
        $container = require __DIR__ . '/../config/di.php';
        Yii::$container->setDefinitions($container['definitions']);
    }
}