# encoding: utf-8
# GVV Watir test
#
# Vérifie ....
#
require 'dbi'
require 'colorize'
require './application_test.rb'

class TestUsers < ApplicationTest
  # --------------------------------------------------------------------------------
  # Run before every test
  # --------------------------------------------------------------------------------
  def setup
    super
    self.db_connect
    self.login('admin', 'admin')
  end

  # --------------------------------------------------------------------------------
  # Executed after each test
  # --------------------------------------------------------------------------------
  def teardown
    self.db_disconnect
    self.logout()
    super
  end


  # --------------------------------------------------------------------------------
  # Test CRUD
  # --------------------------------------------------------------------------------
  def test_crud
    
    table = 'ciauth_user_accounts'
    controller = 'users'
    
    puts "#\tTest case: CRUD for #{table}"
   
    params = {
      'controller' => controller,

      'table' => table,

      'incorrect_values' => [
         {name: 'email_value', value: '', type: 'text_field'},
         {name: 'username_value', value: 'testadmin', type: 'text_field'},
         {name: 'password', value: '', type: 'text_field'},
         {name: 'confirm-password', value: 'tutu', type: 'text_field'}],

      'error_patterns' => ["Email address field is required",
        "User name field must contain a unique", 
        "Confirm Password field does not match"],
      
      'values' => [         {name: 'email_value', value: 'testing@free.fr', type: 'text_field'},
        {name: 'username_value', value: 'testing', type: 'text_field'},
        {name: 'password', value: 'testing', type: 'text_field'},
        {name: 'confirm-password', value: 'testing', type: 'text_field'}
         ],
      'success_patterns' => ["User name"],
      'changes' => [
        {name: 'username_value', value: 'tester', type: 'text_field'}
        ],
       'create_pattern' => 'testing',
       'change_pattern' => 'tester',
       'key_index' => 0}
        
      self.crud(params)          
  end
          
end
