<?php

/**
* File Appender.
*
* @author    Gabriel Alonso <gbr.alonso@gmail.com>
*
*/

namespace Loga\Appenders;

class File extends Appender
{
    private $file;

    public function __construct($file, $level = \Loga\Log::DEBUG)
    {
        parent::__construct($level);

        $this->file = $file;
    }

    public function write($message, $errorLevel)
    {
        $fp = fopen($this->file, 'a');
        fwrite($fp, sprintf("%s [%s] %s \n", date('F j, Y, g:i a'), $errorLevel, $message));
        fclose($fp);
    }
}
