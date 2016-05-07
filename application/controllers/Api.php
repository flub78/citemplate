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
require_once APPPATH . '/third_party/REST_Controller.php';

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

        $this->load->model('crud_model', 'model');

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
     * Vérifie qu'un des éléments du tableau match le pattern
     */
    function matching_row($row, $pattern) {
        foreach ( $row as $elt ) {
            if (stripos($elt, $pattern) !== false) {
                return TRUE;
            }
        }
        return false;
    }

    /**
     * Fetch users
     */
    function user_get() {
        $fields = array (
                        'id',
                        'image',
                        'username',
                        'email',
                        'active',
                        'created_on',
                        'last_login'
                );

        $params = array (
                'controller' => 'users',
                'elt_name' => 'user',
                'table' => 'users_view',
                'fields' => $fields,
                'display_fields' => array (
                        'image',
                        'username',
                        'email',
                        'active',
                        'created_on',
                        'last_login',
                        '__edit',
                        '__delete'
                )
        );
        return $this->get_elements($params);
    }

    /**
     * Fetch group
     */
    function group_get() {
        $fields = array('name', 'description');

        $params = array (
                'controller' => 'groups',
                'elt_name' => 'group',
                'table' => 'groups',
                'fields' => $fields,
                'display_fields' => array('name', 'description', '__edit', '__delete')
        );
        return $this->get_elements($params);
    }

    /**
     * Fetch something
     */
    protected function get_elements($params) {
        $table = $params ['table'];
        $fields = $params ['fields'];
        $display_fields= $params ['display_fields'];
        $elt_name = $params ['elt_name'];
        $controller = $params ['controller'];

        $this->logger->debug($elt_name . '_get ' . var_export($_GET, true));

        $id = $this->get('id');
        $searchArray = $this->get('search');
        $search = $searchArray ['value'];

        // var_dump($search);

        if (! $id) {
            // return several elements

            $start = $this->get('start') ? $this->get('start') : 0;
            $length = $this->get('length') ? $this->get('length') : 10;
            $this->logger->debug("\$start=$start, \$length=$length");

            $attrs = array (
                    'format' => 'datatable'
            );
            if (! $search) {
                // pagination is done by the database only if there is no search
                $attrs ['start'] = $start;
                $attrs ['length'] = $length;
            }

            $users = $this->model->select($table, $fields, array (), $attrs);

            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users) {

                // Set the response and exit
                $total = $this->model->count($table);
                $attrs = [
                        'controller' => $controller,
                        'fields' => $display_fields,
                        'no_header' => true
                ];
                $datatable = datatable($table, $users, $attrs);

                if ($search) {
                    $result = array ();
                    $iFilteredTotal = 0;
                    foreach ( $datatable as $row ) {
                        if ($this->matching_row($row, $search)) {
                            $iFilteredTotal ++;
                            // in the window ?
                            if (($iFilteredTotal >= $start) && ($iFilteredTotal < $start + $length)) {
                                $result [] = $row;
                            }
                        }
                    }
                } else {
                    $iFilteredTotal = $total;
                    $result = $datatable;
                }
                $count = count($result);
                $this->response(array (
                        "iTotalRecords" => $count,
                        "iTotalDisplayRecords" => $iFilteredTotal,
                        'aaData' => $result
                ), REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {

                // Set the response and exit
                $this->response([
                        'status' => FALSE,
                        'message' => 'No '. $elt_name .'s were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        } else {
            // look for one element
            $user = $this->model->get_by_id($table, 'id', $id);
            if ($user) {
                $this->response([
                        'status' => true,
                        'aaData' => $user
                ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            } else {
                $this->response([
                        'status' => FALSE,
                        'message' => 'Invalid ' . $elt_name
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }
}
