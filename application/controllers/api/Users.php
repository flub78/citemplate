// <?php
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
class Users extends REST_Controller {

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

        if (! $this->ion_auth->logged_in()) {
            // Set the response and exit
            $this->response([
                    'status' => FALSE,
                    'message' => 'You must be logged in to call this interface'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }

    /**
     * Fetch users
     */
    function index_get() {
        $users = $this->model->select_all('users_view');

        // Check if the users data store contains users (in case the database result returns NULL)
        if ($users) {
            // Set the response and exit
            $this->response($users, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        } else {
            // Set the response and exit
            $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
            ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
        }
    }
}
