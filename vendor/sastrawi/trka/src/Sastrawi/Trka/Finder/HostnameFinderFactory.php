<?php

namespace Sastrawi\Trka\Finder;

use Sastrawi\Trka\Validator\Hostname as HostnameValidator;

class HostnameFinderFactory
{
    public function create()
    {
        $hostnameValidator = new HostnameValidator();

        return new Hostname($hostnameValidator);
    }
}
