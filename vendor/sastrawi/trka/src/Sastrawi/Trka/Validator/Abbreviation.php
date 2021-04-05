<?php

namespace Sastrawi\Trka\Validator;

class Abbreviation implements ValidatorInterface
{
    private $abbreviations;

    public function __construct(array $abbreviations = array())
    {
        $this->abbreviations = $abbreviations;
    }

    public function isValid($value)
    {
        return in_array(strtolower($value), $this->abbreviations);
    }
}
