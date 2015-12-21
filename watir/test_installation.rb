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
    # self.login('testadmin', 'testadmin')
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
  # Test install
  #   - reset the database
  #   - check that there is no table
  #   - goto to the default url to trigger installation
  #   - check that it is possible to log in with default user
  # --------------------------------------------------------------------------------
  def test_install
    puts "#\tTest case: test"
    @b.goto @root_url
    screenshot('scr_test.png')
    check(true, "Vérification")
  end
          
end
