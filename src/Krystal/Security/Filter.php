<?php

/**
 * This file is part of the Krystal Framework
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Krystal\Security;

use InvalidArgumentException;
use UnexpectedValueException;

class Filter implements Sanitizeable
{
    /**
     * Sanitize a value
     * 
     * @param string $value
     * @param string $filter
     * @return string
     */
    public static function sanitize($value, $filter = self::FILTER_NONE)
    {
        if (!is_scalar($value)) {
            throw new InvalidArgumentException(sprintf('Sanitizer can only handle scalar values. Received "%s"', gettype($value)));
        }

        switch ($filter) {
            case self::FILTER_NONE;
                return $value;
            case self::FILTER_BOOL:
                return (bool) $value;
            case self::FILTER_FLOAT:
                return (float) $value;
            case self::FILTER_INT:
                return (int) $value;
            case self::FILTER_HTML:
                return self::escape($value);
            case self::FILTER_TAGS:
                return self::stripTags($value);
            default:
                throw new UnexpectedValueException('Unknown filter type provided');
        }
    }

    /**
     * Determines whether a string has HTML tags
     * 
     * @param string $target
     * @param array $exceptions Tags to be ignored
     * @return boolean
     */
    public static function hasTags($target, array $exceptions = array())
    {
        return self::stripTags($target, $exceptions) !== $target;
    }

    /**
     * Strip the tags, even malformed ones
     * 
     * @param string $text Target HTML string
     * @param array $allowed An array of allowed tags
     * @return string
     */
    public static function stripTags($text, array $allowed = array())
    {
        // Based on [fernando at zauber dot es]'s solution
        $allowed = array_map('strtolower', $allowed);

        return preg_replace_callback('/<\/?([^>\s]+)[^>]*>/i', function ($matches) use (&$allowed) {
            return in_array(strtolower($matches[1]), $allowed) ? $matches[0] : '';
        }, $text);
    }

    /**
     * Escapes special HTML values
     * 
     * @param string $value
     * @return string
     */
    public static function escape($value)
    {
        return htmlentities($value, \ENT_QUOTES, 'UTF-8');
    }

    /**
     * Escapes HTML content
     * 
     * @param string $content
     * @return string
     */
    public static function escapeContent($content)
    {
        return $content;
    }
}
