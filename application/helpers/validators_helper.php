<?php

/**
 *    Project {$PROJECT}
 *    Copyright (C) 2015 {$AUTHOR}
 *
 *    This program is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This program is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *    Form validators
 */
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );

if (! function_exists ( 'valid_date' )) {
	/**
	 *
	 * @param unknown $date        	
	 */
	function valid_date($date) {
		if ($date == '') {
			return true;
		}
		$parsed = date_parse_from_format ( translation ( "format_date" ), $date );
		
		$translation = translation ( "format_date" );
		// var_dump($translation);
		if ((isset ( $parsed ['warning_count'] ) && $parsed ['warning_count']) || (isset ( $parsed ['error_count'] ) && $parsed ['error_count'])) {
			$CI = & get_instance ();
			$CI->form_validation->set_message ( 'valid_date', translation ( 'valid_date' ) );
			return FALSE;
		}
		$year = $parsed ['year'];
		$month = $parsed ['month'];
		$day = $parsed ['day'];
		
		$result = sprintf ( "%04d-%02d-%02d", $year, $month, $day );
		return $result;
	}
}

if (! function_exists ( 'valid_timestamp' )) {
	/**
	 * Form validation callback
	 *
	 * @param unknown $timestamp        	
	 * @return boolean date_parse_from_format returns array (size=12)
	 *         'year' => int 2015
	 *         'month' => int 11
	 *         'day' => int 5
	 *         'hour' => int 13
	 *         'minute' => int 20
	 *         'second' => int 0
	 *         'fraction' => boolean false
	 *         'warning_count' => int 0
	 *         'warnings' =>
	 *         array (size=0)
	 *         empty
	 *         'error_count' => int 0
	 *         'errors' =>
	 *         array (size=0)
	 *         empty
	 *         'is_localtime' => boolean false
	 */
	function valid_timestamp($ts) {
		$CI = & get_instance ();
		
		if ($ts == '') {
			return true;
		}
		$parsed = date_parse_from_format ( translation ( "format_timestamp" ), $ts );
		
		if (isset ( $parsed ['error_count'] ) && $parsed ['error_count']) {
			$CI->form_validation->set_message ( 'valid_timestamp', translation ( 'valid_timestamp' ) );
			return FALSE;
		}
		$year = $parsed ['year'];
		$month = $parsed ['month'];
		$day = $parsed ['day'];
		$hour = $parsed ['hour'];
		$minute = $parsed ['minute'];
		$second = $parsed ['second'];
		$timestamp = "$year-$month-$day $hour:$minute:$second";
		return $timestamp;
	}
}

if (! function_exists ( 'valid_epoch' )) {
    /**
     *
     * @param unknown $epoch
     */
    function valid_epoch($epoch) {
        $parsed = date_parse_from_format(translation("format_epoch"), $epoch);
        if (isset($parsed ['error_count']) && $parsed ['error_count']) {
			$CI = & get_instance ();
        	$CI->form_validation->set_message('valid_epoch', translation('valid_epoch'));
            return FALSE;
        }
        return strtotime($epoch);
    }
}

if (! function_exists ( 'valid_currency' )) {
    /**
     *
     * @param unknown $currency
     */
    function valid_currency($currency) {
        return $currency;
    }
}

if (! function_exists ( 'valid_time' )) {
    /**
     *
     * @param unknown $time
     */
    function valid_time($time) {
    	if(preg_match('/^(?:[01][0-9]|2[0-3]):[0-5][0-9]$/',$time)) {
    		// $input is valid HH:MM format.
    		return $time;
    	}
        return false;
    }
}

