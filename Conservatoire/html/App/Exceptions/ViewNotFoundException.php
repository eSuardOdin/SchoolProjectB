<?php
declare(strict_types = 1);
namespace App\Exceptions;

class ViewNotFoundException extends \Exception
{
    protected $message = 'The view do not exists BOIIIIIII';

    public function getErrorMessage():string
    {
        return $this->message;
    }
}