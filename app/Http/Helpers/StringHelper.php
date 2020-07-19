<?php

namespace App\Http\Helpers;

class StringHelper
{
    public static function cleanUp($string, $replaceStr)
    {
        //Lower case everything
        $string = strtolower($string);

        //Make alphanumeric (removes all other characters)
        $string = preg_replace("/[^a-z0-9_\s-]/", '', $string);

        //Clean up multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", ' ', $string);

        //Convert whitespaces and underscore to dash
        $string = preg_replace("/[\s_]/", $replaceStr, $string);

        return $string;
    }
}
