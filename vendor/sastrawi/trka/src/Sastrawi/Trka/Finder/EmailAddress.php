<?php

namespace Sastrawi\Trka\Finder;

use Sastrawi\Trka\Util\StringUtil;
use Sastrawi\Trka\Validator\ValidatorInterface;

class EmailAddress implements EntityFinderInterface
{
    private $validator;

    public function __construct(ValidatorInterface $emailAddressValidator)
    {
        $this->validator = $emailAddressValidator;
    }

    public function find($text)
    {
        $atCharPositions = array();
        $tokens  = array();

        for ($i = 0; $i < strlen($text); $i++) {
            if ($text[$i] === '@') {
                $atCharPositions[] = $i;
            }
        }

        foreach ($atCharPositions as $pos) {
            $token = StringUtil::findToken($text, $pos);

            if ($token !== null) {
                $tokens[] = $token;
            }
        }

        foreach ($tokens as $j => $token) {
            if (!$this->validator->isValid($token->getCoveredText($text))) {
                unset($tokens[$j]);
            }
        }

        return array_values($tokens);
    }
}
