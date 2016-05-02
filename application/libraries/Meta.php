<?php
/**
 *    Project {$PROJECT}
 *    Copyright (C) 2015 {$AUTHOR}
 *
 *    This program is free software: you can redistribute it ciand/or modify
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
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * The metadata helper provides a functional API to metadata services.
 * This class singleton (Meta library) is in charge of fetching the information from the database
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
 * * The list or table
 * * The list of fields for each table
 * * a list of attributes for each fields
 *
 * public 'name' => string 'user_id' (length=7)
 * public 'type' => string 'int' (length=3)
 * public 'max_length' => int 11
 * public 'default' => null
 * public 'primary_key' => int 1
 *
 * public 'auto_increment' => int 1
 * public 'allow_null' => boolean false
 *
 * Supported metadata types:
 *
 * boolean:
 * - display with a tick in tables
 * - checkbox for inputs
 *
 * date:
 * time:
 * timestamp:
 * - http://trentrichardson.com/examples/timepicker/
 * datetime:
 *
 * email:
 * password:
 * password-confirm:
 * selector: or foreign keys
 *
 * @author frederic
 *
 */
class Meta {
    protected $CI;
    protected $table_exist; // database metadata
    protected $table_keys; // database metadata
    protected $fields_list; // database metadata
    protected $field_data; // database metadata
    protected $fields; // additional metadata
    protected $is_a_view;
    protected $reference;
    protected $logger;
    protected $registered = array ();

    /**
     * Children of Metadata_type must register so they may be called them by name
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
        if (! isset($this->registered [$name])) {
            $name = 'default';
        }
        return $this->registered [$name];
    }
    /**
     * Constructor
     */
    public function __construct($attrs = array ()) {
        $this->CI = & get_instance();

        $this->logger = new Logger("Metadata");

        $this->table_exist = array ();
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

        $this->CI->load->library("Type_timestamp");
        $this->register('timestamp', $this->CI->type_timestamp);

        $this->CI->load->library("Type_time");
        $this->register('time', $this->CI->type_time);

        $this->CI->load->library("Type_date");
        $this->register('date', $this->CI->type_date);

        $this->CI->load->library("Type_epoch");
        $this->register('epoch', $this->CI->type_epoch);

        $this->CI->load->library("Type_currency");
        $this->register('currency', $this->CI->type_currency);

        $this->CI->load->library("Type_selector");
        $this->register('selector', $this->CI->type_selector);
    }

    /**
     * Initialize the fields metadata
     */
    protected function init() {
        // initialize the caches
        $this->table_keys = array ();
        $this->fields_list = array ();
        $this->field_data = array ();
        $this->fields = array ();
        $this->is_a_view = array ();
        $this->reference = array ();
    }

    /**
     * Check if a table or view exist in the database
     *
     * The routine also fetch table information
     *
     * @param unknown $table
     */
    function table_exists($table) {

        // echo "table_exists($table)" .br();
        if (! array_key_exists($table, $this->table_exist)) {
            // if the table has never been referenced

            $this->table_exist [$table] = $this->CI->db->table_exists($table);

            if ($this->table_exist [$table]) {

                // the table or the view exist in the database

                // fetch database metadata
                $this->fields_list [$table] = $this->CI->db->fields_list($table);
                // Do not use the CI>db->field_data, it does not report enough information
                $fields = $this->CI->model->getTableMetaData($table);

                // $fields contains the table or view information
                // Primary key information may be false for views.
                // var_dump($fields);

                /*
                 * object(stdClass)[31]
                 * public 'name' => string 'privilege_id' (length=12)
                 * public 'type' => string 'int' (length=3)
                 * public 'max_length' => int 11
                 * public 'default' => null
                 * public 'primary_key' => int 1
                 */
                foreach ( $fields as $field ) {

                    // store field information indexed by field
                    $this->field_data [$table] [$field->name] = $field;
                    // set the table primary key
                    if ($field->primary_key) {
                        $this->table_keys [$table] = $field->name;
                    }

                    // var_dump($field);

                    if ($this->is_a_view($table)) {
                        // it is a view, look for data referenced by the field
                        $reference = $this->reference($table, $field->name);
                        $referenced_table = $reference ['table'];
                        $referenced_field = $reference ['field'];

                        // replace field data by pointed field data
                        $this->field_data [$table] [$field->name] = $this->field_data [$referenced_table] [$referenced_field];
                        if ($this->table_keys [$referenced_table] == $referenced_field) {
                            $this->table_keys [$table] = $field->name;
                        }
                    }
                }
            }
        }
        return $this->table_exist [$table];
    }

    /**
     * Check if a table is a database view or a real table
     *
     * @param unknown $table
     * @return boolean
     */
    function is_a_view($table) {

        if (isset($this->is_a_view[$table])) {
            return $this->is_a_view[$table];
        }

        $count = $this->CI->model->count('information_schema.views', array (
                'TABLE_NAME' => $table
        ));
        $this->is_a_view[$table] = ($count > 0);
        return $this->is_a_view[$table];
    }

    /**
     * return the table and field to which a view field points to.
     * No change if it is not a view.
     *
     * @param unknown $table
     * @param unknown $field
     * @return unknown[]
     */
    function reference($table, $field) {

        // check that the table exists in the database
        if (! $this->table_exists($table)) {
            // throw new Exception("Table $table does not exist");
            return array('table' => $table, 'field' => $field);
        }

        // return the cache value
        if (isset($this->reference[$table][$field])) {
            return $this->reference[$table][$field];
        }

        // if it is not a view
        if (! $this->is_a_view($table)) {
            // change nothing
            return array('table' => $table, 'field' => $field);
        }

        // store the view definition in the cache
        $row = $this->CI->model->get_by_id('information_schema.views', 'TABLE_NAME', $table);
        $def = $row ['VIEW_DEFINITION'];
        // remove select and from
        if (preg_match('/select\s(.*)\sfrom.*$/', $def, $matches)) {
            $def_list = $matches [1] . ','; // adding trailing comma
            if (preg_match_all('/(.*)\sAS\s(.*)\,/U', $def_list, $matches)) {

                /**
                 * matches contains an array of array
                 * matches[0] contains every xxx AS yyy,
                 * matches[1] contains the definition
                 * matches[2] contains the fiels id
                 * array (size=3)
                 */

                $i = 0;
                foreach ($matches[2] as $fld) {
                    $definition = $matches[1][$i];
                    $split = preg_split("/\./", $definition);
                    $fld = preg_replace('/\`/', '', $fld);

                    if ('`ci3`' == $split[0]) {
                        // it is a reference to another table
                        $reference_table = preg_replace('/\`/', '', $split[1]);
                        $reference_field = preg_replace('/\`/', '', $split[2]);
                        $this->reference[$table][$fld] = array(
                            'table' => $reference_table,
                            'field' => $reference_field
                        );

                        // echo "$table.$fld => " . $reference_table . '.' . $reference_field . br();
                    }
                    $i++;
                }
            }
        }

        // check again
        if (isset($this->reference[$table][$field])) {
            // recursion if it is a view on a view
            return $this->reference($this->reference[$table][$field]['table'], $this->reference[$table][$field]['field']);
        }

        // nothing found
        // return array($table, $field);
        return array('table' => $table, 'field' => $field);
    }

    /**
     * Return the list of fields of a table
     *
     * @param unknown $table
     */
    function fields_list($table) {
        if (! $this->table_exists($table)) {
            throw new Exception("Table $table does not exist");
        }

        return $this->fields_list [$table];
    }

    /**
     * Return the recommended model to access a table
     *
     * @param unknown_type $table
     */
    function table_model($table) {
        if (isset($this->table_model [$table])) {
            // specific model
            return $this->table_model [$table];
        } else {
            // generic model
            return 'crud_model';
        }
    }

    /**
     * Check if a field exists in database
     *
     * @param unknown_type $table
     * @param unknown_type $field
     */
    function field_exists($table, $field) {
        if (! $this->table_exists($table)) {
            return false;
        }
        return array_key_exists($field, $this->field_data [$table]);
    }

    /**
     * Returns the field database type
     *
     * @param unknown_type $table
     * @param unknown_type $field
     * @return string
     */
    function field_db_type($table, $field) {
        if (! $this->table_exists($table)) {
            return '';
        }

        if (isset($this->field_data [$table] [$field]->type)) {
            return $this->field_data [$table] [$field]->type;
        } else {
            return '';
        }
    }

    /**
     * Returns the field type as it will be used for HTML forms.
     * This is also the metadata type.
     *
     * @param unknown_type $table
     * @param unknown_type $field
     * @return string
     */
    public function field_type($table, $field) {
        if (! isset($this->fields [$table] [$field] ['metadata_type'])) {
            // try to deduce it from the database type
            if ($this->field_exists($table, $field)) {
                $db_type = $this->field_db_type($table, $field);
                $equivalence = array (
                        'varchar' => 'text'
                );
                return (isset($equivalence [$db_type])) ? $equivalence [$db_type] : "";
            } else {
                // throw new Exception("Field $field does not exist in table $table");
                return "";
            }
        } else {
            return $this->fields [$table] [$field] ['metadata_type'];
        }
    }

    /**
     * Returns the field size
     *
     * @param unknown_type $table
     * @param unknown_type $field
     * @return string
     */
    function field_size($table, $field) {
        if (isset($this->fields [$table] [$field] ['size'])) {
            return $this->fields [$table] [$field] ['size'];
        }
        if (! $this->field_exists($table, $field)) {
            throw new Exception("Field $field does not exist in table $table");
        }
        $size = $this->field_data [$table] [$field]->max_length;
        return $size;
    }

    /**
     * Returns the field default
     *
     * @param unknown_type $table
     * @param unknown_type $field
     * @return string
     */
    function field_default($table, $field) {
        if (! $this->field_exists($table, $field)) {
            return '';
        }
        if (isset($this->field_data [$table] [$field]->default)) {
            return $this->field_data [$table] [$field]->default;
        }
        return '';
    }

    /**
     * Returns the field placeholder
     *
     * @param unknown_type $table
     * @param unknown_type $field
     * @return string
     */
    function field_placeholder($table, $field) {
        // if defined in $field
        if (isset($this->fields [$table] [$field] ['placeholder'])) {
            $placeholder = $this->fields [$table] [$field] ['placeholder'];
            $translated = $this->CI->lang->line('placeholder_' . $placeholder);
            // returns direct or translated value
            return ($translated) ? $translated : $placeholder;
        }
        $translated = $this->CI->lang->line('placeholder_' . $table . '_' . $field);

        return ($translated) ? $translated : "";
    }

    /**
     * Returns the field name
     *
     * @param unknown_type $table
     * @param unknown_type $field
     * @return string
     */
    function field_name($table, $field, $full = false) {

        if (isset($this->fields [$table] [$field] ['name'])) {
            return $this->fields [$table] [$field] ['name'];
        } else {
            return ($full) ? $table . '_' . $field : $field;
        }
    }

    /**
     * Returns the field id
     *
     * @param unknown_type $table
     * @param unknown_type $field
     * @return string
     */
    function field_id($table, $field) {
        if (isset($this->fields [$table] [$field] ['id'])) {
            return $this->fields [$table] [$field] ['id'];
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
        if (! $this->table_exists($table)) {
            # return '';
        }
        return isset($this->table_keys [$table]) ? $this->table_keys [$table] : '';
    }

    /**
     * Return the default values for an element
     *
     * @param unknown $table
     */
    function element_default_values($table, $post) {
        if (! $this->table_exists($table)) {
            return array ();
        }
        $values = array ();
        foreach ( $this->fields_list($table) as $field ) {
            $name = $this->field_name($table, $field);
            if (isset($post [$name])) {
                $values [$field] = $post [$name];
            } else {
                $values [$field] = $this->field_default($table, $field);
            }
        }
        return array (
                $table => $values
        );
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
     */
    function rules($table, $field, $action) {
        if (! $this->table_exists($table)) {
            throw new Exception("Table $table does not exist");
        }

        $attrs = array ();
        if (isset($this->fields [$table] [$field])) {
            $attrs = array_merge($attrs, $this->fields [$table] [$field]);
        }
        $foreign_key = $this->foreign_key($table, $field);
        if ($foreign_key) {
            $field_type = 'selector';
            $attrs ['table'] = $foreign_key ['referenced_table'];
            $attrs ['metadata_type'] = 'selector';
            if ($this->allow_null($table, $field)) {
                $attrs ['with'] = 'null';
            }
        } elseif (isset($this->fields [$table] [$field] ['metadata_type'])) {
            $field_type = $this->fields [$table] [$field] ['metadata_type'];
        } else {
            $field_type = $this->field_db_type($table, $field);
        }

        $type_manager = $this->instance_of($field_type);

        if ($type_manager) {
            $this->log("rules generated by " . get_class($type_manager));
            return $type_manager->rules($table, $field, $action);
        }

        throw new Exception("Type manager not found");
    }

    /**
     * Rules to replace computed rules
     *
     * @param unknown_type $table
     * @param unknown_type $field
     */
    public function absolute_rules($table, $field, $action) {
        // Replace default rules
        if (isset($this->fields [$table] [$field] [$action . '_rules'])) {
            return $this->fields [$table] [$field] [$action . '_rules'];
        }
        return null;
    }

    /**
     * Rules to add to computed rules
     *
     * @param unknown_type $table
     * @param unknown_type $field
     */
    public function additional_rules($table, $field, $action) {
        if (isset($this->fields [$table] [$field] ['rules'])) {
            return $this->fields [$table] [$field] ['rules'];
        }
        if (isset($this->fields [$table] [$field] [$action . '_rules'])) {
            return $this->fields [$table] [$field] [$action . '_rules'];
        }
        return "";
    }

    /**
     * Can the field be null
     *
     * @param unknown_type $table
     * @param unknown_type $field
     */
    public function allow_null($table, $field) {
        if (isset($this->field_data [$table] [$field])) {
            $meta = $this->field_data [$table] [$field];
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
    public function max_length($table, $field) {
        if (isset($this->field_data [$table] [$field])) {
            // if this field exist in database
            $meta = $this->field_data [$table] [$field];

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
     * @param
     *            $format
     */
    function display_field($table, $field, $value, $format = "html") {
        $reference = $this->reference($table, $field);
        $table = $reference ['table'];
        $field = $reference ['field'];

        if (! $this->table_exists($table)) {
            // throw new Exception("Table $table does not exist");
            return $value;
        }

        $attrs = array ();
        if (isset($this->fields [$table] [$field])) {
            $attrs = array_merge($attrs, $this->fields [$table] [$field]);
        }

        $foreign_key = $this->foreign_key($table, $field);
        if ($foreign_key) {
            $field_type = 'selector';
            $attrs ['table'] = $foreign_key ['referenced_table'];
            $attrs ['metadata_type'] = 'selector';
            if ($this->allow_null($table, $field)) {
                $attrs ['with'] = 'null';
            }
        } elseif (isset($this->fields [$table] [$field] ['metadata_type'])) {
            $field_type = $this->fields [$table] [$field] ['metadata_type'];
        } else {
            $field_type = $this->field_db_type($table, $field);
        }

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
     * @param
     *            $format
     */
    function field_input($table, $field, $value = '', $attrs = array()) {
        if (! $this->table_exists($table)) {
            throw new Exception("Table $table does not exist");
        }

        // set_value is not used as values are fully managed in to be prep
        // from and to database

        if (isset($this->fields [$table] [$field])) {
            $attrs = array_merge($attrs, $this->fields [$table] [$field]);
        }
        $foreign_key = $this->foreign_key($table, $field);
        if ($foreign_key) {
            $field_type = 'selector';
            $attrs ['table'] = $foreign_key ['referenced_table'];
            $attrs ['metadata_type'] = 'selector';
            if ($this->allow_null($table, $field)) {
                $attrs ['with'] = 'null';
            }
        } elseif (isset($this->fields [$table] [$field] ['metadata_type'])) {
            $field_type = $this->fields [$table] [$field] ['metadata_type'];
        } else {
            $field_type = $this->field_db_type($table, $field);
        }

        // echo "field_input $table $field $field_type" . br();

        $type_manager = $this->instance_of($field_type);
        if ($type_manager) {
            return $type_manager->field_input($table, $field, $value, $attrs);
        }
        throw new Exception("Type manager not found");
    }

    /**
     * The prep function transforms data extracted from the database into data that
     * can be displayed into a form or table.
     * It takes localisation into account.
     *
     * Input format: array (
     * 'table_name' => array('field_name' => 'field_value', ...))
     */
    function prep($values, $format = "html") {
        foreach ( $values as $table => $table_values ) {
            foreach ( $table_values as $field => $value ) {
                $values [$table] [$field] = $this->display_field($table, $field, $value, $format);
            }
        }
        return $values;
    }

    /**
     * Log information on the metadata logger
     *
     * @param unknown_type $msg
     * @param unknown_type $level
     */
    function log($msg, $level = "info") {
        $this->logger->log($level, $msg);
    }

    /**
     * Check if a database field is a foreign key referencing another table.
     *
     * @param unknown $table
     * @param unknown $field
     * @return a hash array('referenced_table' => xxx, 'referenced_field' => yyy)
     */
    function foreign_key($table, $field) {
        $this->CI->load->model('crud_model', 'model');

        $header = array (
                'CONSTRAINT_SCHEMA',
                'CONSTRAINT_NAME',
                'TABLE_SCHEMA',
                'TABLE_NAME',
                'COLUMN_NAME',
                'REFERENCED_TABLE_SCHEMA',
                'REFERENCED_TABLE_NAME',
                'REFERENCED_COLUMN_NAME'
        );

        $database = 'ci3';
        $select = $this->CI->model->select('information_schema.KEY_COLUMN_USAGE', $header, array (
                'CONSTRAINT_SCHEMA' => $database,
                'CONSTRAINT_NAME !=' => 'PRIMARY',
                'TABLE_NAME' => $table,
                'COLUMN_NAME' => $field
        ));

        if (! $select) {
            return false;
        } else {
            return array (
                    'referenced_table' => $select [0] ['REFERENCED_TABLE_NAME'],
                    'referenced_field' => $select [0] ['REFERENCED_COLUMN_NAME']
            );
        }
    }
}

