# encoding: utf-8
# GVV Watir test
#
# Vérifie ....
#
require 'dbi'
require 'colorize'
require './application_test.rb'
require File.dirname(__FILE__) + '/reset_database.rb'


class TestTemplate < ApplicationTest
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
  # Test test
  # --------------------------------------------------------------------------------
  def test_basic_login_an_schema
    description('connection, login, basic schema', 'user action', 'database schema exists')
    @b.goto @root_url
    screenshot('scr_test.png')
    check(true, "Vérification")
    
    table_count = self.table_count(@db)
    check(table_count >= 7, "number of tables after init #{table_count} >= 7")
    
    ResetDatabase.drop
    ResetDatabase.create
    check(self.table_count(@db) == 0, 'all tables have been droped')
    
    ResetDatabase.restore
    check(self.table_count(@db) == 7, 'all tables been restored')
    
    
    
  end
          
end
