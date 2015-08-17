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
 * @filesource Logger.php
 * @package libraries
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Compared to more sophisticated mechanism CodeIgniter logger mechanism
 * lack several features:
 *   - possibility to create loggers per class, module, features, etc.
 *   - possibility to enable or disable them individually
 *   - possibility to redirect their output to different destination
 *   - formating capacity
 *   
 *   This class is just a simple mechanism provide a common interface
 *   to logging. It will be extanded on demand. For the moment its only 
 *   fature is to prefix logg message with a particular pattern so they
 *   can be filtered easily from the log files.
 */
class Logger {
    var $name = "";
 
    function __construct($name = "", $attrs = array()) {
         if ($name) {$this->name = $name;};
    }
    
    function log ($level, $msg) {
    	if ($this->name != "") {
    		$msg = $this->name . ": " . $msg;
    	}
    	log_message($level, $msg); 
    	#echo "$level, $message";
    }
    
    function error($msg) {
    	$this->log('error', $msg);
    }
    
    function debug($msg) {
    	$this->log('debug', $msg);
    }
    
    function info($msg) {
    	$this->log('info', $msg);
    }
    
}

