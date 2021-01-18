<?php

namespace Sastrawi\Trka\Finder;

use Sastrawi\Trka\Validator\Url as UrlValidator;

class UrlFinderFactory
{
    public function create()
    {
        $urlValidator = new UrlValidator();

        return new Url($urlValidator);
    }
}
