<?php

namespace app\modules\webhook\src;

use Yii;
use yii\base\BootstrapInterface;
use yii\web\Application;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public $controllerNamespace = 'app\modules\webhook\src\Http\Controllers';

    public function bootstrap($app): void
    {
        $container = require __DIR__ . '/../config/di.php';
        Yii::$container->setDefinitions($container['definitions']);

        if ($app instanceof Application) {
            $routes = require __DIR__ . '/./../config/routes.php';
            $app->getUrlManager()->addRules($routes);
        }
    }
}