<?php

namespace Sastrawi\Trka\Finder;

use Sastrawi\Trka\Validator\Number as NumberValidator;

class NumberFinderFactory
{
    public function create()
    {
        $numberValidator = new NumberValidator();

        return new Number($numberValidator);
    }
}
