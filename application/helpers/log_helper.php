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
 *    Mécanisme de log spécifique. C'est un helper plutôt qu'une extension de CI_Log
 *    parce que cela permet de séparer les logs applicatifs des logs systèmes.
 *    
 *    J'aurais préféré un mécanisme de log un peu plus sophistiqué style Log4J ou on peut spécifier
 *    les loggers mais CodeIgniter est une Framework minimaliste (cela a aussi des avantages,
 *    même si cela a quelques inconvénients).
 */
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

if (!function_exists('logfile')) {

	/**
	 * Return the file name of the current log file
	 *
	 */
	function logfile() {
		$logname = "log-" . date("Y-m-d") . ".php";
		$logpath = getcwd() . "/application/logs/" . $logname;
		return $logpath;
	}
}

if (!function_exists('log_count')) {
	/**
	 * Retourne la liste des occurences d'une chaine de caractère dans le fichier de log
	 */
	function log_count($pattern) {
		$getText = file_get_contents(logfile(), true);
		return substr_count($getText , $pattern);
	}
	
}
