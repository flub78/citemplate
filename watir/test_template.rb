# encoding: utf-8
# GVV Watir test
#
# Vérifie ....
#
require 'dbi'
require 'colorize'
require './application_test.rb'

class TestTemplate < ApplicationTest
  # --------------------------------------------------------------------------------
  # Run before every test
  # --------------------------------------------------------------------------------
  def setup
    super
    self.db_connect
    # self.login('panoramix', 'password')
  end

  # --------------------------------------------------------------------------------
  # Executed after each test
  # --------------------------------------------------------------------------------
  def teardown
    self.db_disconnect
    # self.logout()
    super
  end


  # --------------------------------------------------------------------------------
  # Test test
  # --------------------------------------------------------------------------------
  def test_test
    puts "#\tTest case: test"
    @b.goto @root_url
    screenshot('scr_test.png')
    check(true, "Vérification")
  end
          
end
