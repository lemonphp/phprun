<?php

namespace Lemon\PHPRun\Utils;

class Path
{
    /**
     * Parse "~" symbol from path.
     *
     * @param string $path
     * @return string
     */
    public static function parseHomeDir($path)
    {
        if (filter_has_var(INPUT_SERVER, 'HOME')) {
            $path = str_replace('~', filter_input(INPUT_SERVER, 'HOME', FILTER_SANITIZE_STRING), $path);
        } elseif (filter_has_var(INPUT_SERVER, 'HOMEDRIVE') && filter_has_var(INPUT_SERVER, 'HOMEPATH')) {
            $path = str_replace('~', filter_input(INPUT_SERVER, 'HOMEDRIVE', FILTER_SANITIZE_STRING) . filter_input(INPUT_SERVER, 'HOMEPATH', FILTER_SANITIZE_STRING), $path);
        }

        return $path;
    }
}