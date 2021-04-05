<?php
/**
 * Sastrawi Trka (https://github.com/sastrawi/trka)
 *
 * @link      http://github.com/sastrawi/trka for the canonical source repository
 * @license   https://github.com/sastrawi/trka/blob/master/LICENSE The MIT License (MIT)
 */

namespace Sastrawi\Trka\Util;

use Sastrawi\String\Span\Span;

/**
 * String utility class.
 *
 * @author Andy Librian
 */
class StringUtil
{
    private static $whitespaceChars = array(' ', "\t", "\n");

    private static $standardEosChars = array('.', '?', '!');

    /**
     * Determine wether a character is a whitespace or not.
     *
     * @param  string $char Character in question.
     * @return bool   True if a character is a whitespace
     */
    public static function isWhitespace($char)
    {
        return (array_search($char, self::$whitespaceChars) !== false);
    }

    /**
     * Get next first whitespace character.
     *
     * @param  string    $string Text to search whitespace character
     * @param  int       $start  Position index to start from
     * @return false|int Return the position of next first whitespace character. False if not found.
     */
    public static function getNextWhitespace($string, $start = -1)
    {
        while ($start < (strlen($string) - 1) && !self::isWhitespace($string[$start + 1])) {
            $start++;
        }

        if ($start === (strlen($string) - 1)) {
            return false;
        }

        $start++;

        return $start;
    }

    /**
     * Get previous first whitespace character.
     *
     * @param  string    $string Text to search whitespace character
     * @param  int       $start  Position index to start from
     * @return false|int Return the position of previous first whitespace character. False if not found.
     */
    public static function getPrevWhitespace($string, $start = null)
    {
        $start = ($start !== null) ? $start : strlen($string);

        while ($start > 0 && !self::isWhitespace($string[$start - 1])) {
            $start--;
        }

        if ($start === 0) {
            return false;
        }

        $start--;

        return $start;
    }

    /**
     * Get next first non whitespace character.
     *
     * @param  string    $string Text to search non whitespace character
     * @param  int       $start  Position index to start from
     * @return false|int Return the position of next first non whitespace character. False if not found.
     */
    public static function getNextNonWhitespace($string, $start = -1)
    {
        while ($start < (strlen($string) - 1) && self::isWhitespace($string[$start + 1])) {
            $start++;
        }

        if ($start === (strlen($string) - 1)) {
            return false;
        }

        $start++;

        return $start;
    }

    /**
     * Get previous first non whitespace character.
     *
     * @param  string    $string Text to search non whitespace character
     * @param  int       $start  Position index to start from
     * @return false|int Return the position of previous first non whitespace character. False if not found.
     */
    public static function getPrevNonWhitespace($string, $start = null)
    {
        $start = ($start !== null) ? $start : strlen($string);

        while ($start > 0 && self::isWhitespace($string[$start - 1])) {
            $start--;
        }

        if ($start === 0) {
            return false;
        }

        $start--;

        return $start;
    }

    public static function getStandardEosChars()
    {
        return self::$standardEosChars;
    }

    public static function findToken($text, $position)
    {
        if ($position < (strlen($text) - 1) && !StringUtil::isWhitespace(substr($text, $position + 1, 1))) {
            $nextWs = StringUtil::getNextWhitespace($text, $position);
            $prevWs = StringUtil::getPrevWhitespace($text, $position);

            $tokenStart = ($prevWs === false) ? 0 : $prevWs + 1;
            $tokenEnd   = (($nextWs === false) ? strlen($text) : $nextWs);

            $token = substr($text, $tokenStart, $tokenEnd - $tokenStart);

            // strip trailing .
            if (!empty($token) && in_array($token[strlen($token) - 1], self::$standardEosChars)) {
                $token = substr($token, 0, strlen($token) - 1);
                $span  = new Span($tokenStart, $tokenEnd - 1);
            } else {
                $span  = new Span($tokenStart, $tokenEnd);
            }

            return $span;
        }
    }
}
