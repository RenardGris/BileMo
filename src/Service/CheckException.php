<?php

namespace App\Service;

use App\Exception\NotFoundException;
use App\Exception\ResourceValidationException;
use Hateoas\Helper\LinkHelper;
use Hateoas\Representation\CollectionRepresentation;
use Hateoas\Representation\PaginatedRepresentation;



class CheckException
{
    public static function checkUserCustomerRelation($user, $customer)
    {
        if($user !== $customer->getUser())
        {
            $exception = new NotFoundException(404);
            $exception->setCustomerNotFoundMessage();
            throw $exception;
        } else {
            return true;
        }
    }

    public static function hasViolations($violations)
    {
        if(count($violations))
        {
            $exception = new ResourceValidationException(400);
            $exception->setMessage($violations);
            throw $exception;
        } else {
            return false;
        }
    }

}