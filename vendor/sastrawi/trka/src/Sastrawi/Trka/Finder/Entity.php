<?php

namespace Sastrawi\Trka\Finder;

class Entity implements EntityFinderInterface
{
    private $finders = array();

    public function __construct(array $finders = array())
    {
        if (!empty($finders)) {
            $this->addFinders($finders);
        }
    }

    public function addFinders(array $finders)
    {
        foreach ($finders as $finder) {
            $this->addFinder($finder);
        }
    }

    public function addFinder(EntityFinderInterface $finder)
    {
        $this->finders[] = $finder;
    }

    public function find($text)
    {
        $spans = array();

        foreach ($this->finders as $finder) {
            $spans = array_merge($spans, $finder->find($text));
        }

        $spans = array_unique($spans);

        return $spans;
    }
}
