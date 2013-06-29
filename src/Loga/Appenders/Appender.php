<?php

/**
* Appender base.
*
* @author    Gabriel Alonso <gbr.alonso@gmail.com>
*
*/

namespace Loga\Appenders;

abstract class Appender
{

    protected $level = \Loga\Log::DEBUG;

    /**
    * Constructor.
    *
    * @param integer $level minimum logging level
    *
    */
    public function __construct($level = \Loga\Log::DEBUG)
    {
        $this->level = $level;
    }

    /**
    * Check if the level of the log is accepted
    *
    * @param string $message
    * @param string $level;
    *
    */
    public function handle($message, $level)
    {
        if (\Loga\Log::$levels[$level] >= $this->level) {
            $this->write($message, $level);
        }
    }

    abstract public function write($message, $errorLevel);
}
