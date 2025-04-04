<?php

namespace app\modules\telegram\src;

use Yii;
use yii\base\BootstrapInterface;
use yii\web\Application;

class Module extends \yii\base\Module implements BootstrapInterface
{
    public $controllerNamespace = 'app\modules\telegram\src\Console\Controllers';

    public function bootstrap($app): void
    {
        $container = require __DIR__ . '/../config/di.php';
        Yii::$container->setDefinitions($container['definitions']);

        if ($app instanceof Application) {
            $this->controllerNamespace = 'app\modules\telegram\src\Http\Controllers';

            $routes = require __DIR__ . '/./../config/routes.php';
            $app->getUrlManager()->addRules($routes);
        }
    }
}