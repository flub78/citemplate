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
        $this->lang->load('flight_logs');
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
     * Display the flight logs for an airfield and a date
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

            // TODO: translate the date depending on the languange
            // date=2016-05-02 french for february
            // English version
            $sdate = substr($d, 8, 2) . substr($d, 5, 2) . substr($d, 0, 4); // mise au format jjmmaaaa

            $url = "http://live.glidernet.org/flightlog";

            $data = array('d' => $sdate, 'a' => $a, 'j' => '2', 's' => $s, 'u' => $u, 'z' => $z);
            $headers = array('Accept' => 'application/json');
            $request = Requests::get($url, $headers, $data);

            if (!$request->success) {
                $data['title'] = "Connection error";
                $data['message'] = "Error from $url" . br() . "Code = " . $request->status_code;
                $this->load->view('message', $data);
            } else {
                $planche = json_decode($request->body, true);

                /**
                 * array (size=5)
                 'date' => string '05022016' (length=8)
                 'airfield' => string 'LFNF' (length=4)
                 'alt_setting' => string 'QFE' (length=3)
                 'unit' => string 'm' (length=1)
                 'flights' =>
                 array (size=6)
                 0 =>
                 array (size=8)
                 'plane' => string 'F-GMKA' (length=6)
                 'glider' => string '' (length=0)
                 'takeoff' => string '13.59' (length=5)
                 'plane_landing' => string '16.17' (length=5)
                 'glider_landing' => string '' (length=0)
                 'plane_time' => string '02h17' (length=5)
                 'glider_time' => string '-----' (length=5)
                 'towplane_max_alt' => string '' (length=0)
                 1 =>
                 array (size=8)
                 'plane' => string 'F-GORY' (length=6)
                 'glider' => string 'F-CHGO' (length=6)
                 'takeoff' => string '14.18' (length=5)
                 'plane_landing' => string '14.26' (length=5)
                 'glider_landing' => string '14.39' (length=5)
                 'plane_time' => string '00h07' (length=5)
                 'glider_time' => string '00h21' (length=5)
                 'towplane_max_alt' => string '818' (length=3)

                 */

                $attrs ['fields'] = array('plane', 'glider', 'takeoff', 'plane_landing', 'glider_landing',
                        'plane_time', 'glider_time', 'towplane_max_alt');
                $data ['controller'] = $this->controller;
                $data ['data_table'] = datatable('flight_logs', $planche['flights'], $attrs);
                $data['table_title'] = 'Flight logs ' . $planche['airfield'];

                $date = $planche['date'];
                $day = substr($date, 0, 2);
                $month = substr($date, 2, 2);
                $year = substr($date, 4, 4);
                $sdate = "$day/$month/$year";
                $data['message'] = "Date = " . $sdate;
                $this->load->view('default_table', $data);

            }


         }
    }

}
