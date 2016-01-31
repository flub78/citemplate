<?php
/**
 * Project {$PROJECT}
 * Copyright (C) 2015 {$AUTHOR}
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @filesource Users.php
 * @package controllers
 *          REST API for users
 */
defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * Users controller
 *
 * @author frederic
 *
 */
class Api extends REST_Controller {

    /**
     * Constructor
     */
    function __construct() {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods ['user_get'] ['limit'] = 500; // 500 requests per hour per user/key
        $this->methods ['user_post'] ['limit'] = 100; // 100 requests per hour per user/key
        $this->methods ['user_delete'] ['limit'] = 50; // 50 requests per hour per user/key

        $this->load->model('users_model', 'model');

        if (! $this->ion_auth->logged_in() && false) {
            // Set the response and exit
            $this->response([
                    'status' => FALSE,
                    'message' => 'You must be logged in to call this interface'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }

        $this->logger = new Logger("class=" . get_class($this));
        $this->logger->debug('New instance of ' . get_class($this));
    }

    /**
     * Fetch users
     */
    function user_get() {

        $this->logger->debug('user_get ' . var_export($_GET, true));

        $id = $this->get('id');
        $iDisplayStart = $this->get('iDisplayStart');
        $iDisplayLength = $this->get('iDisplayLength');
        $this->logger->debug("\$iDisplayStart=$iDisplayStart, \$iDisplayLength=$iDisplayLength");

        if (!$id) {
            $users = $this->model->select('users_view', array('image', 'username', 'email', 'active', 'created_on', 'last_login'), array(), array('format' => 'datatable'));
            $users = $this->model->select_all('users_view');
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users) {
                // Set the response and exit

                $attrs = ['controller' => 'users',
                        array('image', 'username', 'email', 'active', 'created_on', 'last_login', '__edit', '__delete')
                ];
                $datatable = datatable('users_view', $users, $attrs);
                $users = [
                        ["Admin istrator",
       "administrator",
      "admin@admin.com",
       "1",
       "1268889823",
      "1268889823", "edit", "delete"],
                        ["Admin Admin",
      "admin",
       "admin@gmail.com",
       "1",
      "1454218673",
       "1454271347", "edit", "delete"]
                ];
//                     'status' => true,
                $this->response(array(
                    "sEcho" => "0",
                    "iTotalRecords" => "2",
                    "iTotalDisplayRecords" => "2",
                    'aaData' => $users), REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                // Set the response and exit
                $this->response([
                        'status' => FALSE,
                        'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        } else {
            $user = $this->model->get_by_id('users_view', 'id', $id);
            if ($user) {
                $this->response([
                    'status' => true,
                    'aaData' => $user], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->response([
                        'status' => FALSE,
                        'message' => 'Invalid user'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }
}
