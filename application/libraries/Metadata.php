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
class Metadata {
	protected $CI;
	protected $table_exist; 	# database metadata
	protected $fields_list;     # database metadata
	protected $field_data;      # database metadata
	protected $fields;	        # additional metadata
	protected $logger;
	
	/**
	 * Constructor
	 */
	public function __construct($attrs = array ()) {
		$this->CI = & get_instance ();
		
		$this->logger = new Logger("Metadata" );
		
		# initialize the caches
		$this->table_exist = array();
		$this->fields_list = array();
		$this->field_data = array();
		$this->init();
	}
	
	/*
	 * Here starts the metadata description itself
	 * 
	 * For the moment I'll put all metadata here. But later when the application
	 * will grow up, it could make sense to derive this class.
	 */
	
	/**
	 * Initialize the fields metadata 
	 */
	protected function init() {
		
		$this->fields = array();
		
		$this->fields['ciauth_user_accounts']['email'] = array(
            'name' => 'email_value',
			'metadata_type' => 'email',
            'id' => 'email_value',
            'class' => 'form-control',
            'size' => '25'
        );
		$this->fields['ciauth_user_accounts']['username'] = array(
            'name' => 'username_value',
            'type' => 'text',
            'id' => 'username_value',
            'class' => 'form-control',
            'size' => '25',
			'rules' => 'is_unique[ciauth_user_accounts.username]|alpha_dash'
        );
		$this->fields['ciauth_user_accounts']['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'metadata_type' => 'password',
			'class' => 'form-control',
            'size' => '25',
			'rules' => 'min_length[5]'
        );
		// confirm-password is not a real database field
		$this->fields['ciauth_user_accounts']['confirm-password'] = array(
				'name' => 'confirm-password',
				'id' => 'confirm-password',
            	'metadata_type' => 'password',
				'class' => 'form-control',
				'size' => '25',
				'rules' => 'required|matches[password]'
		);
		$this->fields['ciauth_user_accounts']['admin'] = array('metadata_type' => 'boolean');

		$this->fields['ciauth_user_privileges']['privilege_id'] = array('metadata_type' => 'int');
		$this->fields['ciauth_user_privileges']['privilege_name'] = array(
				'metadata_type' => 'text',
				'placeholder' => "Privilege name",
            	'size' => '25'
		);
		$this->fields['ciauth_user_privileges']['privilege_description'] = array(
            	'size' => '25'
		);
	}
 	
	/**
	 * Returns the list of fields to be displayed in a form
	 *
	 * @param unknown_type $table
	 */
	function form_field_list($table) {
		$CI = & get_instance ();
		
		$list = array (
			'ciauth_user_accounts' => array ('email', 'username', 'password', 'confirm-password'),
			'ciauth_user_privileges' => array('privilege_name', 'privilege_description')
		);
		return $list[$table];
	}
	
	/*
	 * End of metadata description
	 * 
	 */
	
	/**
	 * Check if a table or view exist in the database
	 * 
	 * The routine also fetch table information
	 * 
	 * @param unknown $table
	 */
	function table_exists ($table) {
		if (!array_key_exists($table, $this->table_exist)) {
			$this->table_exist[$table] = $this->CI->db->table_exists($table);
			
			if ($this->table_exist[$table]) {
				
				# fetch database metadata
				$this->fields_list[$table] = $this->CI->db->fields_list($table);
				// Do not use the CI>db->field_data, it does not report enough information 
				$fields = $this->CI->model->getTableMetaData($table);
				// $fields = $this->CI->db->field_data($table);
				
				// var_dump($fields);
				/*
				 * object(stdClass)[31]
  					public 'name' => string 'privilege_id' (length=12)
  					public 'type' => string 'int' (length=3)
  					public 'max_length' => int 11
  					public 'default' => null
  					public 'primary_key' => int 1
				 */
				foreach ($fields as $field) {
					$this->field_data[$table][$field->name] = $field;
				}				
			}
		}
		return $this->table_exist[$table];
	}

	/**
	 * Return the list of fields of a table
	 * @param unknown $table
	 */
	function fields_list ($table) {
		if (!$this->table_exists($table)) {throw new Exception("Table $table does not exist");}
		
		return $this->fields_list[$table];
	}
	
	
	/**
	 * Check if a field exists in database
	 * @param unknown_type $table
	 * @param unknown_type $field
	 */
	function field_exists($table, $field) {
		if (!$this->table_exists($table)) {
			return false;
		}
		return array_key_exists($field, $this->field_data[$table]);	
	}
	
	/**
	 * Returns the field database type
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @return string
	 */
	function field_db_type($table, $field) {
		if (!$this->table_exists($table)) {throw new Exception("Table $table does not exist");}
		$type = $this->field_data[$table][$field]->type;
		// var_dump($type);
		return $type;
	}
	
	
	/**
	 * Returns the field type as it will be used for HTML forms. This is also the metadata type.
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @return string
	 */
	function field_type($table, $field) {
		
		if (! isset($this->fields[$table][$field]['metadata_type'])) {
			// try to deduce it from the database type
			if ($this->field_exists($table, $field)) {
				$db_type = $this->field_db_type($table, $field);
				$equivalence = array(
					'varchar'	=> 'text'
				);
				return (isset($equivalence[$db_type])) ? $equivalence[$db_type] : "";
			} else {
				# throw new Exception("Field $field does not exist in table $table");
				return "";
			}
		} else {
			return $this->fields[$table][$field]['metadata_type'];
		}
	}

	/**
	 * Returns the field size
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @return string
	 */
	function field_size($table, $field) {
		if (isset($this->fields[$table][$field]['size'])) {
			return $this->fields[$table][$field]['size'];
		}
		if (!$this->field_exists($table, $field)) {throw new Exception("Field $field does not exist in table $table");}
		$size = $this->field_data[$table][$field]->max_length;
		return $size;
	}
	
	/**
	 * Returns the field default
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @return string
	 */
	function field_default($table, $field) {
		if (!$this->field_exists($table, $field)) {
			throw new Exception("Field $field does not exist in table $table");
		}
		$default = $this->field_data[$table][$field]->default;
		return $default;
	}
	

	/**
	 * Returns the field placeholder
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @return string
	 */
	function field_placeholder($table, $field) {
		// if defined in $field
		if (isset($this->fields[$table][$field]['placeholder'])) {
			$placeholder = $this->fields[$table][$field]['placeholder'];
			$translated = $this->CI->lang->line('placeholder_' . $placeholder);
			// returns direct or translated value
			return ($translated) ? $translated : $placeholder;
		} 
		$translated = $this->CI->lang->line('placeholder_' . $table . '_' . $field);
		
		return ($translated) ? $translated : "";		
	}

	/**
	 * Returns the field name
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @return string
	 */
	function field_name($table, $field, $full = false) {
	
		if (isset($this->fields[$table][$field]['name'])) {
			return $this->fields[$table][$field]['name'];
		} else {
			return ($full) ? $table . '_' . $field : $field;			
		}
	}

	/**
	 * Returns the field id
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @return string
	 */
	function field_id($table, $field) {
	
		if (isset($this->fields[$table][$field]['id'])) {
			return $this->fields[$table][$field]['id'];
		} else {
			return $this->field_name($table, $field);
		}
	}
	
	/*
	 * Returns a table primary key
	 * 
	 * TODO: define what to do in case of multiple keys, return an array ?
	 * TODO: get the information from database
	 */
	function table_key($table) {
		$key = array(
			'ciauth_user_accounts' => 'username',
			'ciauth_user_privileges' => 'privilege_id'
		);
	
		return $key[$table];
	}
	
	protected function add_rule(&$rule, $new_rule) {
		if ($rule) {
			$rule .= '|';
		}
		$rule .= $new_rule;
	}
	
	/**
	 * Return the validation rules deduced from metadata
	 *
	 * rules is invoked in form validation method, metadata must be loaded on demand
	 * 
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * 
	 *   'user_id' => 
    object(stdClass)[34]
      public 'name' => string 'user_id' (length=7)
      public 'type' => string 'int' (length=3)
      public 'default' => null
      public 'max_length' => null
      public 'primary_key' => int 1
      public 'auto_increment' => int 1
      public 'allow_null' => boolean false
  'email' => 
    object(stdClass)[43]
      public 'name' => string 'email' (length=5)
      public 'type' => string 'varchar' (length=7)
      public 'default' => null
      public 'max_length' => null
      public 'primary_key' => int 0
      public 'auto_increment' => int 0
      public 'allow_null' => boolean false
  'username' => 
    object(stdClass)[44]
      public 'name' => string 'username' (length=8)
      public 'type' => string 'varchar' (length=7)
      public 'default' => null
      public 'max_length' => null
      public 'primary_key' => int 0
      public 'auto_increment' => int 0
      public 'allow_null' => boolean false
  'password' => 
    object(stdClass)[45]
      public 'name' => string 'password' (length=8)
      public 'type' => string 'varchar' (length=7)
      public 'default' => null
      public 'max_length' => null
      public 'primary_key' => int 0
      public 'auto_increment' => int 0
      public 'allow_null' => boolean false
  'creation_date' => 
    object(stdClass)[46]
      public 'name' => string 'creation_date' (length=13)
      public 'type' => string 'timestamp' (length=9)
      public 'default' => string 'CURRENT_TIMESTAMP' (length=17)
      public 'max_length' => null
      public 'primary_key' => int 0
      public 'auto_increment' => int 0
      public 'allow_null' => boolean false
  'last_login' => 
    object(stdClass)[47]
      public 'name' => string 'last_login' (length=10)
      public 'type' => string 'timestamp' (length=9)
      public 'default' => null
      public 'max_length' => null
      public 'primary_key' => int 0
      public 'auto_increment' => int 0
      public 'allow_null' => boolean true
  'admin' => 
    object(stdClass)[48]
      public 'name' => string 'admin' (length=5)
      public 'type' => string 'varchar' (length=7)
      public 'default' => null
      public 'max_length' => null
      public 'primary_key' => int 0
      public 'auto_increment' => int 0
      public 'allow_null' => boolean false
  'remember_me' => 
    object(stdClass)[49]
      public 'name' => string 'remember_me' (length=11)
      public 'type' => string 'int' (length=3)
      public 'default' => null
      public 'max_length' => null
      public 'primary_key' => int 0
      public 'auto_increment' => int 0
      public 'allow_null' => boolean false
	 */
	function rules($table, $field) {
		
		$rule = "";
		
		// Rules deduced from the database info
		if ($this->table_exists($table)) {
			if (isset($this->field_data[$table][$field])) {
				
				// if this field exist in database
				$meta = $this->field_data[$table][$field];
				// var_dump($meta);
				
				if (!$meta->allow_null) {
					$this->add_rule($rule, 'required');
				}
				if (array_key_exists('max_length', $meta) && $meta->max_length) {
					$rl = 'max_length[' .  $meta->max_length . ']';
					$this->add_rule($rule, $rl);
				}
			}
		}
		
		// additional rules deduced from metadata types
		if (isset($this->fields[$table][$field]['metadata_type'])) {
			
			if ($this->fields[$table][$field]['metadata_type'] == 'email') {
				$this->add_rule($rule, 'valid_email');
			}
		}

		// additional metadata explicit rules
		if (isset($this->fields[$table][$field]['rules'])) {
			$this->add_rule($rule, $this->fields[$table][$field]['rules']);			
		}
		
		$this->log("rules($table,$field) = " . $rule);
		// return '';
		return $rule;
	}
	
	/**
	 * Log information on the metadata logger
	 * @param unknown_type $msg
	 * @param unknown_type $level
	 */
	function log($msg, $level = "info") {
		$this->logger->log($level, $msg);
	}
}

