<?php

namespace Sastrawi\Trka\Validator;

class Number implements ValidatorInterface
{
    public function isValid($value)
    {
        $value = str_replace(' ', '', $value);
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '', $value);
        $value = str_replace('-', '', $value);

        return (is_numeric($value));
    }
}
