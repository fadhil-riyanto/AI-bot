<?php

namespace Sastrawi\Trka\Finder;

use Sastrawi\Trka\Util\StringUtil;
use Sastrawi\String\Span\Span;
use Sastrawi\Trka\Validator\ValidatorInterface;

class Abbreviation implements EntityFinderInterface
{
    private $validator;

    public function __construct(ValidatorInterface $emailAddressValidator)
    {
        $this->validator = $emailAddressValidator;
    }

    public function find($text)
    {
        $dotCharPositions = array();
        $tokens  = array();

        for ($i = 0; $i < strlen($text); $i++) {
            if ($text[$i] === '.') {
                $dotCharPositions[] = $i;
            }
        }

        foreach ($dotCharPositions as $pos) {
            $token = $this->findToken($text, $pos);

            if ($token !== null) {
                $tokens[] = $token;
            }
        }

        // remove duplicate tokens
        $tokens = array_unique($tokens);

        // validate tokens
        foreach ($tokens as $j => $token) {
            if (!$this->validator->isValid($token->getCoveredText($text))) {
                unset($tokens[$j]);
            }
        }

        return array_values($tokens);
    }

    private function findToken($text, $position)
    {
        if ($position < (strlen($text) - 1)) {
            $nextWs = StringUtil::getNextWhitespace($text, $position);
            $prevWs = StringUtil::getPrevWhitespace($text, $position);

            $tokenStart = ($prevWs === false) ? 0 : $prevWs + 1;
            $tokenEnd   = (($nextWs === false) ? strlen($text) : $nextWs);

            $token = substr($text, $tokenStart, $tokenEnd - $tokenStart);

            $span  = new Span($tokenStart, $tokenEnd);

            return $span;
        }
    }
}
