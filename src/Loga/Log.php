<?php

/**
* Log Class.
*
* @see    https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md
* @author    Gabriel Alonso <gbr.alonso@gmail.com>
*
*/

namespace Loga;

use Psr\Log\AbstractLogger;
use Psr\Log\LogLevel;
use Psr\Log\InvalidArgumentException;
use Loga\Appenders\Appender;

class Log extends AbstractLogger
{
    private $appenders = array();

    const DEBUG = 0;
    const INFO = 10;
    const NOTICE = 20;
    const WARNING = 30;
    const ERROR = 40;
    const CRITICAL = 50;
    const ALERT = 60;
    const EMERGENCY = 70;

    public static $levels = array(
        LogLevel::DEBUG => 0,
        LogLevel::INFO => 10,
        LogLevel::NOTICE => 20,
        LogLevel::WARNING => 30,
        LogLevel::ERROR => 40,
        LogLevel::CRITICAL => 50,
        LogLevel::ALERT => 60,
        LogLevel::EMERGENCY => 70
    );

    /**
    * Constructor
    *
    * @param Apender $appender
    *
    */
    public function __construct(Appender $appender = null)
    {
        if($appender != null)
            array_push($this->appenders, $appender);
    }

    /**
    * Add an appender
    *
    * @param Appender $appender
    */
    public function addAppender(Appender $appender)
    {
        array_push($this->appenders, $appender);
    }

    /**
    * Logs with an arbitrary level.
    *
    * @param mixed $level
    * @param string $message
    * @param array $context
    * @throws \Psr\Log\InvalidArgumentException if the level doesn't exist
    *
    */
    public function log($level, $message, array $context = array())
    {
        if (isset(self::$levels[$level])) {
            foreach ($this->appenders as $appender) {
                $appender->handle($this->interpolate($message, $context), $level);
            }
        } else {
            throw new InvalidArgumentException("Invalid level!", 1);
        }
    }

    /**
    * Interpolates context values into the message placeholders.
    *
    * @param string $message
    * @param array $context
    * @return string
    */
    private function interpolate($message, array $context = array())
    {
        $replace = array();
        foreach ($context as $key => $val) {
            $replace['{' . $key . '}'] = $val;
        }

        return strtr($message, $replace);
    }
}
