<?php
require_once 'vendor/autoload.php';

$fileAppenderDebug = new Loga\Appenders\File("/tmp/debug.log", Loga\Log::DEBUG);
$fileAppenderAlert = new Loga\Appenders\File("/tmp/alert.log", Loga\Log::ALERT);
$fileAppenderNull = new Loga\Appenders\Null();

$log = new Loga\Log();

$log->addAppender($fileAppenderDebug);
$log->addAppender($fileAppenderAlert);
$log->addAppender($fileAppenderNull);

$log->info("Info!");
$log->debug("Debug!");
$log->emergency("Emergency!");
$log->alert("Alert!");
