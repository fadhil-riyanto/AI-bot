<?php
/**
 * Sastrawi Span (https://github.com/sastrawi/string-span)
 *
 * @link      http://github.com/sastrawi/string-span for the canonical source repository
 * @license   https://github.com/sastrawi/string-span/blob/master/LICENSE The MIT License (MIT)
 */

namespace Sastrawi\String\Span;

/**
 * String span interface
 *
 * @author Andy Librian
 */
interface SpanInterface
{
    /**
     * Get the start position.
     *
     * @return int
     */
    public function getStart();

    /**
     * Get the end position.
     *
     * @return int
     */
    public function getEnd();

    /**
     * Get type of the span.
     *
     * @return string
     */
    public function getType();

    /**
     * Get the span length
     *
     * @return int
     */
    public function getLength();

    /**
     * Get covered text by this span.
     *
     * @param  string $text The text
     * @return string
     */
    public function getCoveredText($text);

    /**
     * Returns true if the specified span is contained by this span.
     * Identical spans are considered to contain each other.
     *
     * @param \Sastrawi\String\Span\SpanInterface $span The span to compare with this span.
     *
     * @return bool True is the specified span is contained by this span;
     * false otherwise.
     */
    public function contains(SpanInterface $span);

    /**
     * Returns true if the specified index is contained inside this span.
     * An index with the value of end is considered outside the span.
     *
     * @param int $index The index to test with this span.
     *
     * @return bool True if the span contains this specified index;
     * false otherwise.
     */
    public function containsIndex($index);

    /**
     * Returns true if the specified span is the begin of this span and the
     * specified span is contained in this span.
     *
     * @param \Sastrawi\String\Span\SpanInterface $span The span to compare with this span.
     *
     * @return bool True if the specified span starts with this span and is
     * contained in this span; false otherwise
     */
    public function startsWith(SpanInterface $span);

    /**
     * Returns true if the specified span intersects with this span.
     *
     * @param \Sastrawi\String\Span\SpanInterface $span The span to compare with this span.
     *
     * @return bool True when the spans overlap; false otherwise.
     */
    public function intersects(SpanInterface $span);

    /**
     * Returns true is the specified span crosses this span.
     *
     * @param \Sastrawi\String\Span\SpanInterface $span The span to compare with this span.
     *
     * @return bool True is the specified span overlaps this span and contains a
     * non-overlapping section; false otherwise.
     */
    public function crosses(SpanInterface $span);

    /**
     * Convert to string.
     *
     * @return string
     */
    public function __toString();
}
