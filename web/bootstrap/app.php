<?php

use Illuminate\Foundation\Application;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Contracts\Console\Kernel as ConsoleKernel;
use Illuminate\Contracts\Debug\ExceptionHandler;
use App\Http\Kernel as HttpKernel;
use App\Console\Kernel as AppConsoleKernel;
use App\Exceptions\Handler;

$app = new Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

$app->singleton(
    Kernel::class,
    HttpKernel::class
);

$app->singleton(
    ConsoleKernel::class,
    AppConsoleKernel::class
);

$app->singleton(
    ExceptionHandler::class,
    Handler::class
);

return $app;
