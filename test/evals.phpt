<?php
function php_syntax_error($code)
{
    if (!defined("CR"))
        define("CR", "\r");
    if (!defined("LF"))
        define("LF", "\n");
    if (!defined("CRLF"))
        define("CRLF", "\r\n");
    $braces = 0;
    $inString = 0;
    foreach (token_get_all('<?php ' . $code) as $token) {
        if (is_array($token)) {
            switch ($token[0]) {
                case T_CURLY_OPEN:
                case T_DOLLAR_OPEN_CURLY_BRACES:
                case T_START_HEREDOC:
                    ++$inString;
                    break;
                case T_END_HEREDOC:
                    --$inString;
                    break;
            }
        } else if ($inString & 1) {
            switch ($token) {
                case '`':
                case '\'':
                case '"':
                    --$inString;
                    break;
            }
        } else {
            switch ($token) {
                case '`':
                case '\'':
                case '"':
                    ++$inString;
                    break;
                case '{':
                    ++$braces;
                    break;
                case '}':
                    if ($inString) {
                        --$inString;
                    } else {
                        --$braces;
                        if ($braces < 0) break 2;
                    }
                    break;
            }
        }
    }
    $inString = @ini_set('log_errors', false);
    $token = @ini_set('display_errors', true);
    ob_start();
    $code = substr($code, strlen('<?php '));
    $braces || $code = "if(0){{$code}\n}";
    if (eval($code) === false) {
        if ($braces) {
            $braces = PHP_INT_MAX;
        } else {
            false !== strpos($code, CR) && $code = strtr(str_replace(CRLF, LF, $code), CR, LF);
            $braces = substr_count($code, LF);
        }
        $code = ob_get_clean();
        $code = strip_tags($code);
        if (preg_match("'syntax error, (.+) in .+ on line (\d+)$'s", $code, $code)) {
            $code[2] = (int) $code[2];
            $code = $code[2] <= $braces
                ? array($code[1], $code[2])
                : array('unexpected $end' . substr($code[1], 14), $braces);
        } else $code = array('syntax error', 0);
    } else {
        ob_end_clean();
        $code = false;
    }
    @ini_set('display_errors', $token);
    @ini_set('log_errors', $inString);
    return $code;
}

php_syntax_error('echo "okok";');
