<?php

namespace Src;

use Error;
use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Auth\Auth;

class Application
{
    private Settings $settings;
    private Route $route;
    private Capsule $dbManager;
    private ?Auth $auth = null; // теперь может быть null


    public function __construct(Settings $settings)
    {
        // Привязываем класс со всеми настройками приложения
        $this->settings = $settings;
        $this->auth = new Auth();
        // Привязываем маршрут
        $this->route = new Route($this->settings->getRootPath());

        // Настройка базы данных
        $this->dbManager = new Capsule();
        $this->dbRun();

        // Если в конфиге указаны классы для авторизации — инициализируем
        if (!empty($this->settings->app['auth']) && !empty($this->settings->app['identity'])) {
            $this->auth = new $this->settings->app['auth'];
            $identity = $this->settings->app['identity'];
            $this->auth::init(new $identity);
        }
    }

    public function __get($key)
    {
        switch ($key) {
            case 'settings':
                return $this->settings;
            case 'route':
                return $this->route;
            case 'auth':
                return $this->auth;
        }
        throw new Error('Accessing a non-existent property');
    }

    private function dbRun()
    {
        $this->dbManager->addConnection($this->settings->getDbSetting());
        $this->dbManager->setEventDispatcher(new Dispatcher(new Container));
        $this->dbManager->setAsGlobal();
        $this->dbManager->bootEloquent();
    }

    public function run(): void
    {
        require_once '../routes/web.php';
        Route::start();
    }
}
