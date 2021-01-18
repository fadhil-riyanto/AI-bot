<?php

namespace Sastrawi\Trka\Validator;

use Zend\Validator\Uri as ZendUriValidator;

class Url implements ValidatorInterface
{
    private static $hostnameValidator;

    private static $uriValidator;

    public function isValid($value)
    {
        if (strstr($value, '://') !== false) {
            return self::getUriValidator()->isValid($value);
        } else {
            $hostname = strstr($value, '/', true);

            if ($hostname !== false) {
                return self::getHostnameValidator()->isValid($hostname);
            }
        }

        return false;
    }

    private static function getHostnameValidator()
    {
        if (self::$hostnameValidator === null) {
            self::$hostnameValidator = new Hostname();
        }

        return self::$hostnameValidator;
    }

    private static function getUriValidator()
    {
        if (self::$uriValidator === null) {
            self::$uriValidator = new ZendUriValidator();
        }

        return self::$uriValidator;
    }
}
