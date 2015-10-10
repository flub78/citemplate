<?php
if (!defined('BASEPATH'))
    exit ('No direct script access allowed');

/**
 * This is a simple CRUD model. 
 * 
 * The Crud_model just inherits it without additional method and can
 * be used in simplest cases. More complex models can be derived form it
 * and add additional methods.
 *
 */
class MY_Model extends CI_Model {
    public $table;
    protected $primary_key;

    var $logger;
    
    /**
     * Constructor
     *
     */
    function __construct() {
        parent :: __construct();
        $this->load->library("Logger");
        $this->logger = new Logger("MY_Model");
		$this->logger->debug('New instance of ' . get_class($this));
    }

    /**
     * Accès en lecture au nom de la table
     * @return string
     * @deprecated
     */
    public function table() {
        return $this->table;
    }

    /**
     * Replaced the default CI field_data so that we could determine if the field is a auto_increment
     * 
     * @param unknown $table
     */
	public function getTableMetaData($table) {
		
		/*
		 * Example object in the MetaData
		 *
		 * stdClass::__set_state(array(
		 * 'Field' => 'coupon_no',
		 * 'Type' => 'bigint(20)',
		 * 'Null' => 'NO',
		 * 'Key' => 'PRI',
		 * 'Default' => NULL,
		 * 'Extra' => 'auto_increment',
		 * ))
		 */
		$fields = $this->db->query ( 'DESCRIBE ' . $table )->result ();
		$md = array ();
		foreach ( $fields as $field ) {
			$reg = '/([a-zA-Z]+)\((\d+)\)?/';
			preg_match ( $reg, $field->Type, $matches );
			
			$type = (array_key_exists ( 1, $matches )) ? $matches [1] : NULL;
			// $length = (array_key_exists ( 2, $matches )) ? preg_replace ( '/[^d]/', '', $matches [2] ) : NULL;
			$length = (array_key_exists ( 2, $matches )) ? $matches [2]: NULL;
			$F = new stdClass ();
			$F->name = $field->Field;
			$F->type = $type;
			$F->default = $field->Default;
			$F->max_length = $length;
			$F->primary_key = ($field->Key == 'PRI' ? 1 : 0);
			$F->auto_increment = strripos ( $field->Extra, 'auto_increment' ) !== FALSE ? 1 : 0;
			$F->allow_null = $field->Null === 'YES' ? TRUE : FALSE;
			
			$md [] = $F;
		}
		
		return $md;
	}
    
    /**
     * Retourne le nom de la clé primaire sur la table
     * @return string
     */
//     public function primary_key() {
//         return $this->primary_key;
//     }

    /**
     *    Ajoute un élément
     *
     * @param $data hash des valeurs
     */
    public function create($table, $data) {
        if ($this->db->insert($table, $data)) {
            $last_id = $this->db->insert_id();
            $this->logger->debug("create succesful, table=" . $table  . ", \$last_id=$last_id, data=" . var_export($data, true));
            if (!$last_id) {
                $last_id = $data[$this->primary_key];
                $this->logger->debug("\$last_id=$last_id (\$data[primary_key])");
            }
            return $last_id;
        } else {
        	$this->logger->error("create error: " . var_export($data, false));
            return FALSE;
        }
    }

    /**
     * delete
     * @param unknown_type $where selection des éléments à détruire
     */
    function delete($table, $where = array ()) {
        $this->logger->debug("delete from table=" . $table  . ", where=" . var_export($where, true));
    	$this->db->delete($table, $where);
    }

    /**
     *    Returns a table row as hash
     *
     * @param table
     * @param $keyid
     * @param $keyvalue 
     * @return hash
     */
    public function get_by_id($table, $keyid, $keyvalue) {

        $this->db->where($keyid, $keyvalue);
        $res = $this->db->get($table)->row_array();
        return $res;
    }

    /**
     *    Retourne le premier élément
     *
     * @param $where selection des éléments
     * @return hash des valeurs
     */
    public function get_first($where = array ()) {
        return $this->db->select('*')->from($this->table)->where($where)->limit(1)->get()->row_array(0);
    }

    /**
     *    Edite un element existant
     *
     *    @param integer $id    $id de l'élément
     *    @param hash  $data donnée à remplacer
     *    @return bool        Le résultat de la requête
     */
    public function update($table, $keyid, $data, $keyvalue = '') {
    	$msg = "update table=" . $table  . ", id=$keyvalue, data=" . var_export($data, true);
    	$this->logger->debug($msg);
    	 
        if ($keyvalue == '') $keyvalue = $data[$keyid];
        $this->db->where($keyid, $keyvalue);
        unset($data[$keyid]);
        $this->db->update($table, $data);
    }

    /**
     * Return the ID of last inserted element
     */
    function get_last_inserted() {
    	return $this->db->insert_id();
    }
    
    /**
     *    Retourne le nombre de membres
     *
     *    @param array $where    Tableau associatif permettant de définir des conditions
     *    @return integer        Le nombre de news satisfaisant la condition
     */
    public function count($table, $where = array ()
    		) {
        $this->db->where($where);
        return $this->db->count_all_results($table);
    }

    /**
     *    Retourne une liste d'objets
     *
     * <pre>
     *  foreach ($list as $line) {
     *     $this->table->add_row($line->mlogin,
     *     $line->mprenom,
     *     $line->mnom,
     * </pre>
     * 
     *    @param integer $nb      taille de la page
     *    @param integer $debut nombre à sauter
     *    @return objet          La liste
     */
    public function list_of($where = array (), $nb = 100, $debut = 0) {
        return $this->db->select('*')->from($this->table)->where($where)->limit($nb, $debut)->get()->result();
    }

    /**
     *    Retourne un tableau
     *
     *  <pre>
     *  foreach ($list as $line) {
     *     $line['mlogin'], $line['mnom']
     *  </pre>
     *  @param $columns
     *  @param $nb taille de la page
     *  @param $where selection
     *    @return objet          La liste
     */
//     public function select_columns($columns, $nb = 0, $debut = 0, $where = array ()) {
//         if ($nb) { 
//             return $this->db->select($columns)->from($this->table)->where($where)->limit($nb, $debut)->get()->result_array();
//         } else {
//             return $this->db->select($columns)->from($this->table)->where($where)->get()->result_array();            
//         }
//     }

    /**
     *    Retourne un tableau
     *
     *  <pre>
     *  foreach ($list as $line) {
     *     $line['mlogin'], $line['mnom']
     *  </pre>
     *  
     *  @param $where selection
     *    @return objet          La liste
     */
    public function select_all($table, $where = array (), $order_by = "") {
    	
    	if (! $table) {
    		throw new Exception ("select_all called with no table");
    	}

    	if ($order_by) {
    		return $this->db->from($table)
        	->where($where)
        	->order_by($order_by)
        	->get()->result_array();    		
    	} else {
    		return $this->db->from($table)
        	->where($where)
        	->get()->result_array();
    	}
    }

    /**
     * This string identifies an element in human readable maned.
     * Likely overloaded.
     * @param $key identifiant de la ligne à représenter
     */
    public function image($table, $key) {
        return $key;
    }

    /**
     *    Retourne un hash qui peut-être utilisé dans un menu drow-down
     *
     * @param $where selection
     * @param $order ordre de tri
     */
//     public function selector($where = array (), $order = "asc") {
//         $key = $this->primary_key;

//         $allkeys = $this->db->select($key)->from($this->table)->where($where)->get()->result_array();

//         $result = array ();
//         foreach ($allkeys as $row) {
//             $value = $row[$key];
//             $result[$value] = $this->image($value);
//         }
//         if ($order == "asc") {
//              natcasesort($result);
//         } else {
//             arsort($result);
//         }
//         return $result;
//     }

    /**
     * Retourne un hash qui peut-être utilisé dans un menu drow-down
     * avec une entrée "Tous .."
     *
     * @param $where selection
     */
    public function selector_with_all($where = array ()) {
    	// TODO delete comments
//         $key = $this->primary_key;

//         $allkeys = $this->db->select($key)->from($this->table)->where($where)->get()->result_array();

//         $result = array ();
//         foreach ($allkeys as $row) {
//             $value = $row[$key];
//             $result[$value] = $this->image($value);
//         }
//         asort($result);
        $result = $this->selector($where);
        $result[''] = $this->lang->line("gvv_tous") . ' ...';
        return $result;

    }

    /**
     * Retourne un hash qui peut-être utilisé dans un menu drow-down
     * avec une entrée vide
     * 
     * @param $where selection
     */
//     public function selector_with_null($where = array ()) {
//         $allkeys = $this->selector($where);
//         $result = array ();
//         $result[''] = '';
//         foreach ($allkeys as $key => $value) {
//             $result[$key] = $value;
//         }
//         return $result;
//     }

    /**
     * Génère un selecteur d'année contenant toutes les années possibles pour une table
     * @param $date_field champ contenant la date dont extraire l'année
     */
//     public function getYearSelector($date_field) {
//         $query = $this->db->select("YEAR($date_field) as year")
//         ->from($this->table)
//         ->order_by("$date_field ASC")
//         ->group_by('year')->get()->result_array();

//         $year_selector = array ();

//         foreach ($query as $key => $row) {
//             $year_selector[$row['year']] = $row['year'];
//         }
//         return $year_selector;
//     }

}

/* End of file MY_Model.php */
/* Location: ./application/core/MY_Model.php */