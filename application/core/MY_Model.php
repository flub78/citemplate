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

    /**
     * Constructor
     *
     */
//     function __construct() {
//         parent :: __construct();
//     }

    /**
     * Accès en lecture au nom de la table
     * @return string
     */
    public function table() {
        return $this->table;
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
    public function create($data) {
        if ($this->db->insert($this->table, $data)) {
            $last_id = $this->db->insert_id();
            gvv_debug("create succesful, table=" . $this->table  . ", \$last_id=$last_id, data=" . var_export($data, true));
            if (!$last_id) {
                $last_id = $data[$this->primary_key];
                gvv_debug("\$last_id=$last_id (\$data[primary_key])");
            }
            return $last_id;
        } else {
        	gvv_error("create error: " . var_export($data, false));
            return FALSE;
        }
    }

    /**
     * delete
     * @param unknown_type $where selection des éléments à détruire
     */
    function delete($table, $where = array ()) {
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
    public function update($keyid, $data, $keyvalue = '') {
        if ($keyvalue == '') $keyvalue = $data[$keyid];
        $this->db->where($keyid, $keyvalue);
        unset($data[$keyid]);
        $this->db->update($this->table, $data);
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
     * Retourne une chaine de caractère qui identifie une ligne de façon unique.
     * Cette chaine est utilisé dans les affichages.
     * Par défaut elle retourne la valeur de la clé, mais elle est conçue pour être
     * surchargée.
     * @param $key identifiant de la ligne à représenter
     */
    public function image($key) {
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