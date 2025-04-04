<?php

namespace app\modules\core\src\Helpers;

/**
 * Хелпер помощник для всего
 */
class UtilsHelper
{
    public static function outputFormat($format = null, $formatValues = []): string
    {
        foreach ($formatValues as $key => $value) {
            $format = str_replace(sprintf('{%s}', $key), $value, $format);
        }

        return $format;
    }
}