<?php


namespace app\sys\exceptions;


use Exception;

class ExceptionHandler
{
    /**
     * @param Exception $exception
     */
    public function handler($exception)
    {
        echo "<h1>" . $exception->getMessage() . "</h1>";
        echo "<pre>" . $exception->getTraceAsString() . "</pre>";
        exit();
    }
}
