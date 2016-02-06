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
 * @filesource FlightLogs.php
 * @package controllers
 *
 * Example of a REST client
 *
 * "http://live.glidernet.org/flightlog/";
 */
defined('BASEPATH') or exit('No direct script access allowed');

// First, include Requests
include(APPPATH . '/third_party/Requests.php');

// Next, make sure Requests can load internal classes
Requests::register_autoloader();

/**
 * Rights controller
 *
 * @author frederic
 *
 */
class Flight_logs extends MY_Controller {
    var $default_table = 'groups';
    var $controller = 'groups';
    var $form_fields = array (
            'name',
            'description'
    );
    var $table_fields = array (
            'name',
            'description',
            '__edit',
            '__delete'
    );

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        // specific initialization
        $this->load->model('groups_model', 'model');
    }

    /**
     * Select the flight logs to display
     */
    function select() {
        $data = array (
                'title' => 'Flight logs select'
        );
        $this->load->view('flight_logs/select', $data);
    }

    /**
     * Display the flight logs for a airfield and a date
     */
    function display() {

        // set rules
        $this->form_validation->set_rules('a', "Airfield", "required|max_length[4]");
        $this->form_validation->set_rules('d', "Date", "required|callback_valid_date");

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        // var_dump($_POST);exit;

        if ($this->form_validation->run() == FALSE) {
            // invalid input, reload the form
            $this->load->view('flight_logs/select');

        } else {
            // successful validation
            $t = $this->input->post('t');
            $a = $this->input->post('a');
            $d = $this->input->post('d');
            $s = $this->input->post('s');
            $u = $this->input->post('u');
            $z = $this->input->post('z');
            $sdate = substr($d, 8, 2) . substr($d, 5, 2) . substr($d, 0, 4); // mise au format jjmmaaaa

            $url = "http://live.glidernet.org/flightlog";

            $data = array('d' => $sdate, 'a' => $a, 'j' => '2', 's' => $s, 'u' => $u, 'z' => $z);
            $headers = array('Accept' => 'application/json');
            $request = Requests::get($url, $headers, $data);

            // var_dump($request);
            echo "success: " .  $request->success .br();
            echo "code: " .  $request->status_code .br();
            // echo "body: " . $request->body;

            $planche = json_decode($request->body, true);
            var_dump($planche);

         }
    }

}
