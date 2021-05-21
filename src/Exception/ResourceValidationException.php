<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\HttpException;


class ResourceValidationException extends HttpException
{

    public function setMessage($violations)
    {

        $message = 'The JSON sent contains invalid data. Here are the errors you need to correct: ';
        foreach ($violations as $violation) {
            $message .= sprintf("Field %s: %s ", $violation->getPropertyPath(), $violation->getMessage());
        }

        $this->message = $message;
    }

}
