<?php

namespace Sastrawi\Trka\Validator;

class EmailAddress implements ValidatorInterface
{
    public function isValid($value)
    {
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }
}
