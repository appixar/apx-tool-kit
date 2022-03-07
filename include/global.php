<?php
/*
 * Example:
 *      > php vhost-create domain.com --restart www.domain.com test --blau=12345
 * 
 * Results:
 *      $argx
 *          ['--restart'] = true
 *          ['--blau'] = 12345
 *      $args
 *          [0] = domain.com
 *          [1] = www.domain.com (1! jumps --restart)
 *          [2] = test
 */

// TERMINAL ONLY
if (PHP_SAPI !== "cli") exit;

// BUILD ARGX
$argx = array();
$args = array();
for ($i = 1; $i < count($argv); $i++) {
    $param = $argv[$i];
    if (substr($param, 0, 2) === '--') {
        $equal = @explode('=', $param)[1];
        if ($equal) $argx[explode('=', $param)[0]] = $equal;
        else $argx[$param] = true;
    } else $args[] = $param;
}
