<?php
/**
 * Sastrawi Span (https://github.com/sastrawi/string-span)
 *
 * @link      http://github.com/sastrawi/string-span for the canonical source repository
 * @license   https://github.com/sastrawi/string-span/blob/master/LICENSE The MIT License (MIT)
 */

namespace Sastrawi\String\Span;

/**
 * String span implementation
 *
 * @author Andy Librian
 */
class Span implements SpanInterface
{
    /**
     * @var int
     */
    private $start = 0;

    /**
     * @var int
     */
    private $end = 0;

    /**
     * @var string
     */
    private $type;

    /**
     * Constructor
     *
     * @param int $start
     * @param int $end
     * @param string|null $type
     */
    public function __construct($start, $end, $type = null)
    {
        if (!is_int($start) || $start < 0) {
            throw new \InvalidArgumentException("start index must be zero or greater: $start given.");
        }

        if (!is_int($end) || $end < 0) {
            throw new \InvalidArgumentException("end index must be zero or greater: $end given.");
        }

        if ($start > $end) {
            throw new \InvalidArgumentException(
                "start index can not be greater than end index: start=$start, end=$end"
            );
        }

        $this->start = $start;
        $this->end   = $end;
        $this->type  = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * {@inheritdoc}
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function getLength()
    {
        return $this->end - $this->start;
    }

    /**
     * {@inheritdoc}
     */
    public function getCoveredText($text)
    {
        return substr($text, $this->start, $this->getLength());
    }

    /**
     * {@inheritdoc}
     */
    public function contains(SpanInterface $span)
    {
        return $this->start <= $span->getStart() && $span->getEnd() <= $this->end;
    }

    /**
     * {@inheritdoc}
     */
    public function containsIndex($index)
    {
        return $this->start <= $index && $index < $this->end;
    }

    /**
     * {@inheritdoc}
     */
    public function startsWith(SpanInterface $span)
    {
        return $this->getStart() == $span->getStart() && $this->contains($span);
    }

    /**
     * {@inheritdoc}
     */
    public function intersects(SpanInterface $span)
    {
        $sstart = $span->getStart();

        //either $span's start is in this or this' start is in $span
        return $this->contains($span) || $span->contains($this) ||
            $this->getStart() <= $sstart && $sstart < $this->getEnd() ||
            $sstart <= $this->getStart() && $this->getStart() < $span->getEnd();
    }

    /**
     * {@inheritdoc}
     */
    public function crosses(SpanInterface $span)
    {
        $sstart = $span->getStart();

        //either $span's start is in this or this' start is in $span
        return !$this->contains($span) && !$span->contains($this) &&
           ($this->getStart() <= $sstart && $sstart < $this->getEnd() ||
           $sstart <= $this->getStart() && $this->getStart() < $span->getEnd());
    }

    /**
     * {@inheritdoc}
     */
    public function __toString()
    {
        $string = '['.$this->getStart().'..'.$this->getEnd().')';

        if ($this->getType() !== null) {
            $string .= ' '.$this->getType();
        }

        return $string;
    }
}
