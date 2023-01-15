<?php

class StringHelper
{
    
    public static function floatToCurrency($float, $sign='', $format='eu')
    {
        return $sign.substr_replace(round($float * 100), ($format === 'eu' ? ',' : '.'), -2, 0);
    }

    public static function sanitizeURI($string)
    {
        return trim(preg_replace("/[^[:alnum:][:space:]]/ui", '', $string)); // Remove anything that's not utf-8 alfanumeric
    }
    
    public static function slugify($string)
    {
        $string = str_replace('+', ' plus ', $string);
        $string = str_replace('&', ' and ', $string);
        $string = str_replace('@', ' at ', $string);
        $string = str_replace('%', ' percent ', $string);
        $string = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', SELF::sanitizeURI($string)); // Try to transliterate utf-8 to ascii or dump characters
        return str_replace(' ', '-', trim(preg_replace('!\s+!', ' ', strtolower($string)))); // Replace all spaces with single dash and lowercase
    }
    
    public static function truncate($string, $maxlength=80, $trailing='...')
    {
        if(strlen($string) >= $maxlength){
            $wordarray = str_word_count(substr($string, 0, $maxlength), 1);
            array_pop($wordarray);
            return implode(' ',$wordarray).$trailing;
        } else return $string;
    }
}