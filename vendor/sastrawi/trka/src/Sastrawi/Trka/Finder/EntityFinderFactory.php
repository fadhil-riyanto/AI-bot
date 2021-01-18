<?php

namespace Sastrawi\Trka\Finder;

class EntityFinderFactory
{
    public function create()
    {
        $finders = array();

        $abbr     = new AbbreviationFinderFactory();
        $number   = new NumberFinderFactory();
        $email    = new EmailAddressFinderFactory();
        $hostname = new HostnameFinderFactory();
        $url      = new UrlFinderFactory();

        $finders[] = $abbr->create();
        $finders[] = $number->create();
        $finders[] = $email->create();
        $finders[] = $hostname->create();
        $finders[] = $url->create();

        $entityFinder = new Entity($finders);

        return $entityFinder;
    }
}
