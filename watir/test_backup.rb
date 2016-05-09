# encoding: utf-8
# GVV Watir test
#
# Checks database backup and restore
#
require 'dbi'
require 'colorize'
require './application_test.rb'
require 'fileutils'

class TestBackup < ApplicationTest
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
  def test_backup
    description('backup is created', 'called by program')

    @b.goto @root_url
    screenshot('scr_test.png')
    
    download_dir = ENV['HOME'] + '/Téléchargements'
    download_dir = @download_directory
    
    check(File.directory?(download_dir), "download dir #{download_dir} exists")
    
    d = DateTime.now
    pattern = d.strftime("backup_%Y%m%d")
    
    pwd = Dir.getwd
    Dir.chdir(download_dir)   #=> 0
    
    files = Dir.glob("#{pattern}*.zip")
        
    count = files.count
    files.each do |file|
      puts "#\t\tdeleting #{file}"
      FileUtils.rm(file)
    end
    
    files = Dir.glob("#{pattern}*.zip")
    count = files.count
    check(count == 0, "previous backups have been deleted")
    
    url = @root_url + 'databaseMgt/backup'
    # puts "url=" + url 
     
    @b.goto url
    
    files = Dir.glob("#{pattern}*.zip")
    count = files.count
    check(count == 1, "one backup has been created: " + files[0])
    
    Dir.chdir(pwd) 

  end
          
end
