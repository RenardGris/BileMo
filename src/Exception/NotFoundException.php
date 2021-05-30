<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;


class NotFoundException extends HttpException
{

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function setCustomerNotFoundMessage()
    {
        self::setMessage('Customer not found');
        $this->setMessage('Customer not found');
    }

}
