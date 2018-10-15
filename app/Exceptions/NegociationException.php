<?php
/**
 * Created by PhpStorm.
 * User: servidor
 * Date: 11/10/18
 * Time: 15:59
 */

namespace App\Exceptions;


use Mockery\Exception;
use Throwable;

class NegociationException extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}