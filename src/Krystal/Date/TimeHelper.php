<?php

/**
 * This file is part of the Krystal Framework
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Krystal\Date;

use LogicException;

/**
 * Time related helper methods 
 */
abstract class TimeHelper
{
    const MINUTE = 60; 
    const SECOND = 1;
    const DAY = 86400;
    const WEEK = 604800;
    const MONTH = 2592000;
    const YEAR = 31536000;

    /**
     * Returns months sequence
     * 
     * @param array $months
     * @param string $target Target months
     * @param boolean $withCurrent Whether to include target months in resultset
     * @throws \LogicException if $target is out of range
     * @return array
     */
    private static function getMonthSequence(array $months, $target, $withCurrent)
    {
        if (!in_array($target, $months)) {
            throw new LogicException(
                sprintf('Target month "%s" is out of range. The range must be from 01 up to 12', $target)
            );
        }

        $collection = array();

        foreach ($months as $month) {
            if ($month == $target) {
                if ($withCurrent === true) {
                    $collection[] = $month;
                }
                break;
            } else {
                $collection[] = $month;
            }
        }

        return $collection;
    }

    /**
     * Returns a collection of previous months
     * 
     * @param string $target
     * @param string $withCurrent Whether to include $target in resultset
     * @return array
     */
    public static function getPreviousMonths($target, $withCurrent = true)
    {
        return self::getMonthSequence(self::getMonths(), $target, $withCurrent);
    }

    /**
     * Returns a collection of next months
     * 
     * @param string $target
     * @param string $withCurrent Whether to include $target in resultset
     * @return array
     */
    public static function getNextMonths($target, $withCurrent = true)
    {
        $months = self::getMonths();
        $months = array_reverse($months);

        $result = self::getMonthSequence($months, $target, $withCurrent);
        return array_reverse($result);
    }

    /**
     * Returns a collection of month numbers with leading zeros
     * 
     * @return array
     */
    public static function getMonths()
    {
        return array(
            '01',
            '02',
            '03',
            '04',
            '05',
            '06',
            '07',
            '08',
            '09',
            '10',
            '11',
            '12'
        );
    }

    /**
     * Return quarters
     * 
     * @return array
     */
    public static function getQuarters()
    {
        return range(1, 4);
    }

    /**
     * Returns a collection of months by associated quarter
     * 
     * @param integer $quarter
     * @throws \LogicException If invalid quarter supplied
     * @return array
     */
    public static function getAllMonthsByQuarter($quarter)
    {
        switch ($quarter) {
            case 1:
                return self::getMonthsByQuarter(1);
            case 2:
                return array_merge(self::getMonthsByQuarter(1), self::getMonthsByQuarter(2));
            case 3:
                return array_merge(self::getMonthsByQuarter(1), self::getMonthsByQuarter(2), self::getMonthsByQuarter(3));
            case 4:
                return array_merge(self::getMonthsByQuarter(1), self::getMonthsByQuarter(2), self::getMonthsByQuarter(3), self::getMonthsByQuarter(4));
            default:
                throw new LogicException(sprintf('Invalid quarter supplied - %s', $quarter));
        }
    }

    /**
     * Returns a collection of months by associated quarter
     * 
     * @param integer $quarter
     * @throws \LogicException If invalid quarter supplied
     * @return array
     */
    public static function getMonthsByQuarter($quarter)
    {
        switch ($quarter) {
            case 1:
                return array('01', '02', '03');
            case 2:
                return array('04', '05', '06');
            case 3:
                return array('07', '08', '09');
            case 4:
                return array('10', '11', '12');
            default:
                throw new LogicException(sprintf('Invalid quarter supplied - %s', $quarter));
        }
    }

    /**
     * Returns current quarter
     * 
     * @param integer $month Month number without leading zeros
     * @return integer
     */
    public static function getQuarter($month = null)
    {
        if ($month === null) {
            $month = date('n', abs(time()));
        }

        if (in_array($month, range(1, 3))) {
            return 1;
        }

        if (in_array($month, range(4, 6))) {
            return 2;
        }

        if (in_array($month, range(7, 9))) {
            return 3;
        }

        if (in_array($month, range(10, 12))) {
            return 4;
        }
    }

    /**
     * Create years
     * 
     * @param integer $start Starting year
     * @param integer $end Ending year
     * @return array
     */
    public static function createYears($start, $end)
    {
        $result = array();

        for ($i = $start; $i < $end + 1; $i++) {
            $result[$i] = $i;
        }

        return $result;
    }

    /**
     * Create years up to current one
     * 
     * @param integer $start Starting year
     * @param integer $end Ending year
     * @return array
     */
    public static function createYearsUpToCurrent($start)
    {
        return self::createYears($start, date('Y'));
    }
}
