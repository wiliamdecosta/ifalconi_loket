<?php

function getVarClean($name, $type = '', $defaultValue = NULL)
{
    $var = getVar($name);
    $var = cleanVar($var);

    if ($var == '' && $defaultValue !== NULL){
        return $defaultValue;
    }

    if (!isset($type)) return $var;

    switch ($type) {
        case 'bool':
            if (is_bool($var)) return $var;
            break;
        case 'str':
        case 'string':
            if (is_string($var)) return $var;
            break;
        case 'object':
            if (is_object($var)) return $var;
            break;
        case 'array':
            if (is_array($var)) return $var;
            break;
        case 'float':
        case 'int':
        case 'numeric':
            if (is_numeric($var)) return $var;
            break;
        default:
            return $var;
    }

    if (isset($defaultValue)) return $defaultValue;

    return '';
}

function cleanVar($var)
{
    $search = array('|</?\s*SCRIPT[^>]*>|si',
                    '|</?\s*FRAME[^>]*>|si',
                    '|</?\s*OBJECT[^>]*>|si',
                    '|</?\s*META[^>]*>|si',
                    '|</?\s*APPLET[^>]*>|si',
                    '|</?\s*LINK[^>]*>|si',
                    '|</?\s*IFRAME[^>]*>|si',
                    '|STYLE\s*=\s*"[^"]*"|si');
    // short open tag <  followed by ? (we do it like this otherwise our qa tests go bonkers)
    $replace = array('');
    // Clean var
    $var = preg_replace($search, $replace, $var);

    return $var;
}

function getVar($name, $allowOnlyMethod = NULL)
{
    if ($allowOnlyMethod == 'GET') {
        if (isset($_GET[$name])) {
            // Then check in $_GET
            $value = $_GET[$name];
        } else {
            // Nothing found, return void
            return;
        }
    } elseif ($allowOnlyMethod == 'POST') {
        if (isset($_POST[$name])) {
            // First check in $_POST
            $value = $_POST[$name];
        } else {
            // Nothing found, return void
            return;
        }
    } else {
        if (isset($_POST[$name])) {
            // Then check in $_POST
            $value = $_POST[$name];
        } elseif (isset($_GET[$name])) {
            // Then check in $_GET
            $value = $_GET[$name];
        } else {
            // Nothing found, return void
            return;
        }
    }

    if (get_magic_quotes_gpc()) {
        $value = __stripslashes($value);
    }
    return $value;
}

function __stripslashes($value)
{
    $value = is_array($value) ? array_map(array('self','__stripslashes'), $value) : stripslashes($value);
    return $value;
}

function get_ip_address() {
    // check for shared internet/ISP IP
    if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }

    // check for IPs passing through proxies
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // check if multiple ips exist in var
        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
            $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($iplist as $ip) {
                if (validate_ip($ip))
                    return $ip;
            }
        } else {
            if (validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
        return $_SERVER['HTTP_X_FORWARDED'];
    if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
        return $_SERVER['HTTP_FORWARDED_FOR'];
    if (!empty($_SERVER['HTTP_FORWARDED']) && validate_ip($_SERVER['HTTP_FORWARDED']))
        return $_SERVER['HTTP_FORWARDED'];

    // return unreliable ip since all else failed
    return $_SERVER['REMOTE_ADDR'];
}

/**
 * Ensures an ip address is both a valid IP and does not fall within
 * a private network range.
 */
function validate_ip($ip) {
    if (strtolower($ip) === 'unknown')
        return false;

    // generate ipv4 network address
    $ip = ip2long($ip);

    // if the ip is set and not equivalent to 255.255.255.255
    if ($ip !== false && $ip !== -1) {
        // make sure to get unsigned long representation of ip
        // due to discrepancies between 32 and 64 bit OSes and
        // signed numbers (ints default to signed in PHP)
        $ip = sprintf('%u', $ip);
        // do private network range checking
        if ($ip >= 0 && $ip <= 50331647) return false;
        if ($ip >= 167772160 && $ip <= 184549375) return false;
        if ($ip >= 2130706432 && $ip <= 2147483647) return false;
        if ($ip >= 2851995648 && $ip <= 2852061183) return false;
        if ($ip >= 2886729728 && $ip <= 2887778303) return false;
        if ($ip >= 3221225984 && $ip <= 3221226239) return false;
        if ($ip >= 3232235520 && $ip <= 3232301055) return false;
        if ($ip >= 4294967040) return false;
    }
    return true;
}

?>