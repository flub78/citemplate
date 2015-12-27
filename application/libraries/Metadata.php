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
 * @filesource Metadata.php
 * @package libraries
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * The metadata helper provides a functional API to metadata services.
 * This class singleton is in charge of fetching the information from the database
 * and to cache it.
 *
 * For performance, metadata are only fetched once and on demand from database
 * even if the same information is used several times to build a view.
 *
 * Design
 *
 * Initially I thought about to put all metadata in database, as some of the metadata
 * information are fetch from database if seems logical to have only one source
 * of information. But then I need a model just to fetch it and have it available
 * from a PHP class. So it is more efficient to just put the additional metadata
 * as a set of arrays into the PHP class, it save all database related accesses
 * and this information is static, it is never change following a user action.
 *
 * Data fetched from the databaser are:
 *    * The list or table
 *    * The list of fields for each table
 *    * a list of attributes for each fields
 *
          public 'name' => string 'user_id' (length=7)
          public 'type' => string 'int' (length=3)
          public 'max_length' => int 11
          public 'default' => null
          public 'primary_key' => int 1

          public 'auto_increment' => int 1
          public 'allow_null' => boolean false
 *
 * @author frederic
 *
 */

include_once ("Meta.php");

class Metadata extends Meta {

	/*
	 * Here starts the metadata description itself
	 */

	/**
	 * Initialize the fields metadata
	 */
	protected function init() {

		$this->fields = array();

		/*
		 * users
		 */
		$this->fields['users']['email'] = array(
            'name' => 'email_value',
			'metadata_type' => 'email',
            'id' => 'email_value',
            'class' => 'form-control',
            'size' => '25'
        );
		$this->fields['users']['username'] = array(
            'name' => 'username_value',
            'type' => 'text',
            'id' => 'username_value',
            'class' => 'form-control',
            'size' => '25',
			'rules' => 'is_unique[users.username]|alpha_dash'
        );
		$this->fields['users']['password'] = array(
            'id' => 'password',
            'metadata_type' => 'password',
			'class' => 'form-control',
            'size' => '25',
			'edit_rules' => 'trim|callback_null_or_min_length[5]',
			'create_rules' => 'required|trim|min_length[5]'
        );
		// confirm-password is not a real database field
		$this->fields['users']['confirm-password'] = array(
				'name' => 'confirm-password',
				'id' => 'confirm-password',
            	'metadata_type' => 'password',
				'class' => 'form-control',
				'size' => '25',
				'rules' => 'trim|matches[password]'
		);

		/*
		 * groups
		 */
		$this->fields['groups']['privilege_id'] = array('metadata_type' => 'int');
		$this->fields['groups']['privilege_name'] = array(
				'metadata_type' => 'text',
				'placeholder' => "Privilege name",
            	'size' => '25'
		);
		$this->fields['groups']['privilege_description'] = array(
            	'size' => '25'
		);
	}

}

