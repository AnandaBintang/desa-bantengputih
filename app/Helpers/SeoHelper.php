<?php

namespace App\Helpers;

class SeoHelper
{
    public static function generateTitle($title, $separator = ' - ')
    {
        return $title . $separator . 'Desa Bantengputih';
    }

    public static function generateDescription($content, $limit = 160)
    {
        return substr(strip_tags($content), 0, $limit);
    }

    public static function generateKeywords($keywords)
    {
        $defaultKeywords = ['desa bantengputih', 'karanggeneng', 'lamongan', 'jawa timur'];
        return implode(', ', array_merge($keywords, $defaultKeywords));
    }
}
