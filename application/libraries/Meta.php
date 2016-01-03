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
 * Supported metadata types:
 *
 *    boolean:
 *       - display with a tick in tables
 *       - checkbox for inputs
 *
 *    date:
 *    time:
 *    timestamp:
 *       - http://trentrichardson.com/examples/timepicker/
 *    datetime:
 *
 *    email:
 *    password:
 *    password-confirm:
 *    keys:
 *
 * Addition of new metadata types
 * ------------------------------
 *
 *    * Modify display_field in this class
 *    * Modify field_input in this class
 *    * Modify rules in this class
 *    * Add validation callback in the core
 *
 *    Note that it would be more elegant to declare a MetadataType class.
 *
 * @author frederic
 *
 */
class Meta {
	protected $CI;
	protected $table_exist; 	# database metadata
	protected $table_keys;   	# database metadata
	protected $fields_list;     # database metadata
	protected $field_data;      # database metadata
	protected $fields;	        # additional metadata
	protected $logger;

	protected $registered = array ();

    /**
     * Children of Metadata_type must register so one may call them by name
     *
     * @param unknown $name
     * @param unknown $object
     */
    protected function register($name, $object) {
        $this->registered [$name] = $object;
    }

    /*
     * Return the instance object in charge of managing one type
     */
    protected function instance_of($name) {
        if (!isset($this->registered [$name])) {
            $name = 'default';
        }
        return $this->registered [$name];
    }
	/**
	 * Constructor
	 */
	public function __construct($attrs = array ()) {
		$this->CI = & get_instance ();

		$this->logger = new Logger("Metadata" );

		# initialize the caches
		$this->table_exist = array();
		$this->table_keys = array();
		$this->fields_list = array();
		$this->field_data = array();
		$this->init();

		// load all the supported types
		$this->CI->load->library("Metadata_type");
		$this->register('default', $this->CI->metadata_type);

		$this->CI->load->library("Type_boolean");
		$this->register('boolean', $this->CI->type_boolean);

 		$this->CI->load->library("Type_email");
		$this->register('email', $this->CI->type_email);

 		$this->CI->load->library("Type_password");
 		$this->register('password', $this->CI->type_password);

//  		$this->CI->load->library("Type_timestamp");
//  		$this->register('timestamp', $this->CI->type_timestamp);

	}

	/**
	 * Initialize the fields metadata
	 */
	protected function init() {

		$this->fields = array();
	}


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
					if ($field->primary_key) {
						$this->table_keys[$table] = $field->name;
					}
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
		if (!$this->table_exists($table)) {
			return '';
		}

		if (isset($this->field_data[$table][$field]->type)) {
			return $this->field_data[$table][$field]->type;
		} else {
			return '';
		}
	}


	/**
	 * Returns the field type as it will be used for HTML forms. This is also the metadata type.
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @return string
	 */
	public function field_type($table, $field) {

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
			return '';
		}
		if (isset($this->field_data[$table][$field]->default)) {
			return $this->field_data[$table][$field]->default;
		}
		return '';
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
		if (!$this->table_exists($table)) {
			return '';
		}
		return $this->table_keys[$table];
	}

	/**
	 * Return the default values for an element
	 * @param unknown $table
	 */
	function element_default_values($table, $post) {
		if (!$this->table_exists($table)) {
			return array();
		}
		$values = array();
		foreach ($this->fields_list($table) as $field) {
			$name = $this->field_name($table, $field);
			if (isset($post[$name])) {
				$values[$field] = $post[$name];
			} else {
				$values[$field] = $this->field_default($table, $field);
			}
		}
		return array($table => $values);
	}


	/**
	 * Return the validation rules deduced from metadata
	 *
	 * rules is invoked in form validation method, metadata must be loaded on demand
	 *
	 * @param unknown_type $table
	 * @param unknown_type $field
	 * @param unknown_type $action
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
	function rules($table, $field, $action) {

		if (isset($this->fields[$table][$field]['metadata_type'])) {
			$field_type = $this->fields[$table][$field]['metadata_type'];
		} else {
		    $field_type = $this->field_db_type($table, $field);
		}

        $type_manager = $this->instance_of($field_type);
        // $type_manager = Metadata_type::instance_of($field_type);
        if ($type_manager) {
            return $type_manager->rules($table, $field, $action);
        }

        throw new Exception("Type manager not found");
//         $rule = "";

		// Rules deduced from the database info
// 		if ($this->table_exists($table)) {
// 			if (isset($this->field_data[$table][$field])) {

// 				// if this field exist in database
// 				$meta = $this->field_data[$table][$field];
// 				// var_dump($meta);

// 				$metadata_type = (isset($this->fields[$table][$field]['metadata_type'])) ?
// 						$this->fields[$table][$field]['metadata_type'] :
// 						'';

// 				if ($meta->type == 'timestamp') {
// 					$this->add_rule($rule, 'callback_valid_timestamp');
// 				} elseif ($meta->type == 'date') {
// 					$this->add_rule($rule, 'callback_valid_date');
// 				} elseif ($meta->type == 'time') {
// 					$this->add_rule($rule, 'callback_valid_time');
// 				}

	}

	/**
	 * Rules to replace computed rules
	 *
	 * @param unknown_type $table
	 * @param unknown_type $field
	 */
	 public function absolute_rules ($table, $field, $action) {
	 	// Replace default rules
		if (isset($this->fields[$table][$field][$action . '_rules'])) {
			return $this->fields[$table][$field][$action . '_rules'];
		}
	    return null;
	}

	/**
	 * Rules to add to computed rules
	 *
	 * @param unknown_type $table
	 * @param unknown_type $field
	 */
	public function additional_rules ($table, $field) {
		if (isset($this->fields[$table][$field]['rules'])) {
		    return $this->fields[$table][$field]['rules'];
		}
	    return "";
	}

	/**
	 * Can the field be null
	 *
	 * @param unknown_type $table
	 * @param unknown_type $field
	 */
	public function allow_null ($table, $field) {
	    if (isset($this->field_data[$table][$field])) {
	        $meta = $this->field_data[$table][$field];
	        return $meta->allow_null;
	    }
        return true;
	}

	/**
	 * Can the field be null
	 *
	 * @param unknown_type $table
	 * @param unknown_type $field
	 */
	public function max_length ($table, $field) {
	    if (isset($this->field_data[$table][$field])) {
	        // if this field exist in database
	        $meta = $this->field_data[$table][$field];

	        if (array_key_exists('max_length', $meta) && $meta->max_length) {
	            return $meta->max_length;
	        }
	        return 0;
	    }
	    return 0;
	}


	/**
	 * Transform a field from the database into something suitable for display
	 *
	 * So it mainly takes formating and languages into account.
	 *
	 * @param unknown $table
	 * @param unknown $field
	 * @param unknown $value
	 * @param $format
	 */
	function display_field($table, $field, $value, $format = "html") {

		if (isset($this->fields[$table][$field]['metadata_type'])) {
			$field_type = $this->fields[$table][$field]['metadata_type'];
		} else {
		    $field_type = $this->field_db_type($table, $field);
		}

        //$type_manager = Metadata_type::instance_of($field_type);
        $type_manager = $this->instance_of($field_type);
        if ($type_manager) {
            return $type_manager->display_field($table, $field, $value, $format);
        }
        throw new Exception("Type manager not found");
	}

	/**
	 * Generate a form field input
	 *
	 * @param unknown $table
	 * @param unknown $field
	 * @param unknown $value
	 * @param $format
	 */
	function field_input($table, $field, $value = '', $attrs = array()) {

		// set_value is not used as values are fully managed in to be prep
		// from and to database

		if (isset($this->fields[$table][$field]['metadata_type'])) {
			$field_type = $this->fields[$table][$field]['metadata_type'];
		} else {
		    $field_type = $this->field_db_type($table, $field);
		}

        // $type_manager = Metadata_type::instance_of($field_type);
		$type_manager = $this->instance_of($field_type);
        if ($type_manager) {
            return $type_manager->field_input($table, $field, $value, $attrs);
        }
        throw new Exception("Type manager not found");
	}

	/**
	 * The prep function transforms data extracted from the database into data that
	 * can be displayed into a form or table. It takes localisation into account.
	 *
	 * Input format: array (
	 *    'table_name' => array('field_name' => 'field_value', ...))
	 *
	 */
	function prep($values, $format = "html") {
		foreach ($values as $table => $table_values) {
			foreach ($table_values as $field => $value) {
				$values[$table][$field] = $this->display_field($table, $field, $value, $format);
			}
		}
		return $values;
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

