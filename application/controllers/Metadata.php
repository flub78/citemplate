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
 * @package controllers
 * Controleur de gestion des ...
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Livre {
	var $titre;
	var $auteur;
	var $prix;

	function __construct($attrs = array()) {
		// print "In BaseClass constructor\n";
		 if (array_key_exists('titre', $attrs)) {$this->titre = $attrs['titre'];};
		 if (array_key_exists('auteur', $attrs)) {$this->auteur = $attrs['auteur'];};
		 if (array_key_exists('prix', $attrs)) {$this->prix = $attrs['prix'];};
	}
	
	function image() {
		return "Livre: titre=" . $this->titre 
		. ", auteur=" . $this->auteur
		. ", prix=" . $this->prix;
	}
	
	function display() {
		echo $this->image();
	}
}

/**
 * Metadata controller
 * @author frederic
 *
 */
class Metadata extends CI_Controller {

	var $logger;
	
	function __construct() {
		parent :: __construct();
		$this->load->helper('metadata');
		$this->load->helper('log');		
		$this->load->library('logger');	

		$this->logger = new Logger("class=" . get_class($this));
	}
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$livre1 = new Livre(array('titre' => 'Le Petit Prince',
				'auteur' => 'Antoine de Saint Exupery', 'prix' => 100));
		$livre2 = new Livre(array('titre' => 'La bible'));
			
		$data = array();
		$data['titi'] = 12;
		$data['html'] = '<input type="text" name="username" value="" id="username" size="30"  /> ';
		$data['hello'] = translation("monde");
		
		$data['livre1'] = $livre1;
		$data['livre2'] = $livre2;
		
		$data['hash'] = array (
				'kiwi' => 12,
				'orange' => 9,
				'pomme' => 7);
		
		$this->load->view('metadata', $data);
	}
	
	/**
	 * Liste les tables en base
	 */
	public function tables() {
		$this->load->model('metadata_model', 'metadata');
		$res = $this->metadata->tables();
		echo "tables de la base, res=" .var_export($res, true);
		$this->logger->debug('Log debugging message');
	}
	
	/**
	 * Test unitaire du controlleur
	 */
	function test ($format = "html") {
		// parent::test($format);
		$this->unit_test = TRUE;
		$this->load->library('unit_test');
	
		echo $this->unit->run(true, true, "Metadata Unit Tests");
		// $this->tests_results($format);
	}
	
}
