<?php

namespace Sastrawi\Trka\Finder;

use Sastrawi\Trka\Validator\Abbreviation as AbbreviationValidator;

class AbbreviationFinderFactory
{
    private $abbreviations = array();

    public function create()
    {
        $abbreviations = explode("\n", file_get_contents(__DIR__.'/../../../../data/abbreviations.txt'));
        foreach ($abbreviations as $i => $abbr) {
            if (empty($abbr)) {
                unset($abbreviations[$i]);
            }
        }

        $abbreviations = array_merge($abbreviations, $this->abbreviations);

        $abbreviationValidator = new AbbreviationValidator($abbreviations);

        return new Abbreviation($abbreviationValidator);
    }

    public function addAbbreviations(array $abbreviations)
    {
        foreach ($abbreviations as $abbreviation) {
            $lower = strtolower($abbreviation);
            if (!in_array($lower, $this->abbreviations)) {
                $this->abbreviations[] = $lower;
            }
        }
    }

    public function getAbbreviations()
    {
        return $this->abbreviations;
    }
}
