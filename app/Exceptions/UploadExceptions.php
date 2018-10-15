<?php
/**
 * Created by PhpStorm.
 * User: servidor
 * Date: 15/10/18
 * Time: 10:05
 */

namespace App\Exceptions;


use Mockery\Exception;
use Throwable;

class UploadExceptions extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}