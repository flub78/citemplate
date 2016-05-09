# encoding: utf-8
# GVV Watir test
#
# Vérifie ....
#
require 'dbi'
require 'colorize'
require './application_test.rb'

class TestInstallation < ApplicationTest
  # --------------------------------------------------------------------------------
  # Run before every test
  # --------------------------------------------------------------------------------
  def setup
    super
    self.db_connect
    # self.login('admin', 'admin')
  end

  # --------------------------------------------------------------------------------
  # Executed after each test
  # --------------------------------------------------------------------------------
  def teardown
    self.db_disconnect
#    self.logout()
    super
  end


  # --------------------------------------------------------------------------------
  # Test install
  #   - reset the database
  #   - check that there is no table
  #   - goto to the default url to trigger installation
  #   - check that it is possible to log in with default user
  # --------------------------------------------------------------------------------
  def test_install
    description('program is installed', 'on any database initial state')


    # Reset the database    
    sql = 'DROP DATABASE `ci3`;'
    sth = @db.execute(sql)

    sql = 'CREATE DATABASE `ci3`;'
    sth = @db.execute(sql)

    @db.disconnect
    @db = DBI.connect('DBI:Mysql:ci3', 'ci3', 'ci3')
        
    # check that there is no table
    count = self.table_count(@db)
    self.check(count == 0, 'No tables after reset');    

    # goto to base url to trigger the installation
     @b.goto @root_url
    
    # check that it is possible to log with default username
    self.login('admin', 'admin')

    # check that tables have been created
    count = self.table_count(@db)
    self.check(count > 0, 'Tables have been created during installation');    

    self.logout()
  end
          
end
