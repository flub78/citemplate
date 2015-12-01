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
 *	Program configuration
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Titre des pages HTML
|--------------------------------------------------------------------------
*/
$config['program_title'] = "CI template";


/*
|--------------------------------------------------------------------------
| Interdit l'accès sauf aux admins
|--------------------------------------------------------------------------
*/
$config['locked'] = FALSE;

/*
 |--------------------------------------------------------------------------
 | Unknown users are allowed to register themselves
 |--------------------------------------------------------------------------
 */
$config['autoregister'] = FALSE;

/*
 |--------------------------------------------------------------------------
 | Automatic installation
 |--------------------------------------------------------------------------
 */
$config['check_install'] = true;

/*
 |--------------------------------------------------------------------------
 | Automatic migration when database version is older than program version
 | Disable if you want to force a former database schema.
 | Automatic migration happens when
 |   * An admin logs in
 |   * this flag is true
 |   * migrations are enabled in the migration config file
 [   * the database schema is not up to date
 |--------------------------------------------------------------------------
 */
$config['auto_migration'] = FALSE;

/* End of file program.php */
/* Location: .application/config/program.php */
