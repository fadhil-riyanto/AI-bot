<?php

namespace Sastrawi\Trka\Finder;

use Sastrawi\Trka\Validator\EmailAddress as EmailAddressValidator;

class EmailAddressFinderFactory
{
    public function create()
    {
        $emailAddressValidator = new EmailAddressValidator();

        return new EmailAddress($emailAddressValidator);
    }
}
