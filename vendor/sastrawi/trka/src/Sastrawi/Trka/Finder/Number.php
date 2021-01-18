<?php

namespace Sastrawi\Trka\Finder;

use Sastrawi\Trka\Util\StringUtil;
use Sastrawi\Trka\Validator\ValidatorInterface;

class Number implements EntityFinderInterface
{
    private $numericSeparators = array('.', ',');

    private $validator;

    public function __construct(ValidatorInterface $numberValidator)
    {
        $this->validator = $numberValidator;
    }

    public function find($text)
    {
        $charPositions = $this->scanCharPositions($text);
        $tokens  = array();

        foreach ($charPositions as $pos) {
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

    private function scanCharPositions($text)
    {
        $charPositions = array();
        $skippedCharPositions = array();

        for ($i = 0; $i < strlen($text); $i++) {
            if (is_numeric($text[$i]) || in_array($text[$i], $this->numericSeparators)) {
                if (empty($charPositions)) {
                    $charPositions[] = $i;
                } elseif (in_array($i-1, $charPositions) || in_array($i-1, $skippedCharPositions)) {
                    $skippedCharPositions[] = $i;
                    continue;
                } else {
                    $charPositions[] = $i;
                }
            }
        }

        return $charPositions;
    }
}
