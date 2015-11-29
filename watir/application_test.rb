# encoding: utf-8
# GVV unit test
# Test de la home page
#
gem "minitest"
require 'minitest/autorun'
require "minitest/ci"
require "minitest/pride"
require 'watir-webdriver'
require './os.rb'
require 'headless' if !OS.windows?

Minitest::Ci.clean = false

class ApplicationTest < MiniTest::Test
  
  # Constructor
  def initialize(arg)
    super
    puts "\n# " + self.class.to_s
  end
  
  # --------------------------------------------------------------------------------
  # Run before every test
  # --------------------------------------------------------------------------------
  def setup
    @base_url = 'http://localhost/jenkins_bb/'
    if ENV['BASE_URL']
      @base_url = ENV['BASE_URL']
    end
    @root_url = @base_url + 'index.php/'

    if !OS.windows? && !ENV['DISPLAY_TESTS']
      @headless = Headless.new
      @headless.start
    end
    
    @download_directory = "#{Dir.pwd}/downloads"
    profile = Selenium::WebDriver::Firefox::Profile.new
    profile['browser.download.folderList'] = 2 # custom location
    profile['browser.download.dir'] = @download_directory
    profile['browser.helperApps.neverAsk.saveToDisk'] = "text/csv,application/pdf,application/octet-stream"
     
    @b = Watir::Browser.new :firefox, :profile => profile
    
    # @b = Watir::Browser.new
    @b.window.resize_to(1200, 900)
  end

  # --------------------------------------------------------------------------------
  # GVV login
  # input assertion: not logged in yet
  # --------------------------------------------------------------------------------
  def login (user, password, expected_success=true)
    @b.goto @base_url
    screenshot('scr_before_login.png')
    @b.text_field(:id => 'login_value').set user
    @b.text_field(:id => 'password').set password
    @b.button(:type => 'submit').click
    screenshot('scr_after_login_click.png')
    if (expected_success)
      check(@b.text.include?(user), "utilisateur #{user} connecté")
    end
    screenshot('scr_after_login.png')
  end

  # --------------------------------------------------------------------------------
  # GVV logout
  # input assertion: logged in
  # --------------------------------------------------------------------------------
  def logout ()
    @b.link(:id => 'logout').click
    screenshot('scr_logged_out.png')
  end

  # --------------------------------------------------------------------------------
  # Executed after each test
  # --------------------------------------------------------------------------------
  def teardown
    @b.close
    @headless.destroy if (!OS.windows? && !ENV['DISPLAY_TESTS'])
  end

  # --------------------------------------------------------------------------------
  # Connect to the database
  # --------------------------------------------------------------------------------
  def db_connect
    @db = DBI.connect('DBI:Mysql:ci3', 'ci3', 'ci3')
    check(@db, "database connected")
  end

  # --------------------------------------------------------------------------------
  # Disonnect from the database
  # --------------------------------------------------------------------------------
  def db_disconnect
    @db.disconnect
    assert_equal(@db.handle, nil, "Database connection closed")
  end

  # --------------------------------------------------------------------------------
  # Assert with traces
  # --------------------------------------------------------------------------------
  def check(assertion, description = "")
    puts "#\t\tassert: #{description}"
    assert(assertion, description)
    if (!assertion)
      self.screenshot('failed-' + DateTime.now.to_s + '-' + description)
    end
  end

  # --------------------------------------------------------------------------------
  # save a screenshot
  # --------------------------------------------------------------------------------
  def screenshot(filename)
    @b.screenshot.save 'screenshots/' + filename
  end

  # --------------------------------------------------------------------------------
  # Check that the user can access to a relative url
  # url: to check
  # must_find: list of pattern that should be find in the page
  # must_not_find: list of pattern that must not be found in the page
  # --------------------------------------------------------------------------------
  def can_access(url, view_name, must_find, must_not_find)
    # Absolute url
    if url =~ /^http/
      target_url = url
    else
      target_url = @root_url + url
    end

    puts "can_access #{url}"
    @b.goto target_url
    # url_name = url
    @b.screenshot.save 'screenshots/scr_' + view_name + '.png'

    must_find.each do |str|
      check(@b.text.include?(str), '"' + str + '" found in ' + view_name)
    end

    must_not_find.each do |str|
      check(!@b.text.include?(str), '"' + str + '" not found in ' + view_name)
    end

  end
  
  # --------------------------------------------------------------------------------
  # open an url
  # --------------------------------------------------------------------------------
  def goto(url, screenshot_name = "")
    @b.goto(url)
    puts "\turl: #{url}"
    if (screenshot_name == "")
      normalized_url = url.gsub("/", "_")
      normalized_url = normalized_url.gsub(":", "")
      screenshot_name = "url_" + normalized_url + ".png"
    end
    sleep(1)
    screenshot(screenshot_name)
  end

  # --------------------------------------------------------------------------------
  # Return the number of rows in a table
  # --------------------------------------------------------------------------------
  def table_count (dbh, table, where = "")
    sql = "select COUNT(*) from #{table}"
    if (where != "")
      sql += " WHERE #{where}"
    end
    sql += ";"

    # puts "sql = #{sql}"
    row = dbh.select_one(sql)
    return row[0]
  end


  
  # --------------------------------------------------------------------------------
  # Create an element into a table
  # --------------------------------------------------------------------------------
  def fill_form(table, url, values, must_find, created, screenshot_name = "")
    initial_count = self.table_count(@db, table)

    @b.goto  @root_url + url
    @b.wait_until {@b.text.include? "Page rendered"}
    
    values.each do |field|
      type = field[:type]
      name = field[:name]
      value = field[:value]
      # puts "field #{name} value=#{value} type=#{type}"
      
      case type
      when 'text_field'
        @b.text_field(:name => name).set value
        @b.text_field(:name => name).fire_event "onchange"
      when 'textarea'
        @b.textarea(:name => name).set value
      when 'checkbox'
        @b.checkbox(:name => name, :value => value).set
      when 'checkbox-clear'
        @b.checkbox(:name => name, :value => value).clear
      when 'radio'
        id = field[:id]
        @b.radio(:id => id, :name => name).set
      when 'select'
        s = @b.select_list(:name => name)
        s.select(value)
      else
      end
    end

    if (screenshot_name != "") 
      self.screenshot(screenshot_name + ".png")
    end
    
    @b.button(:id => 'submit_button').click

    if (screenshot_name != "") 
      self.screenshot(screenshot_name + "_ent.png")
    end
    
    must_find.each do |str|
      check(@b.text.include?(str), '"' + str + "\" found after #{table} form filled")
    end

    count = self.table_count(@db, table)
    check(count - initial_count == created, "#{created} element created in #{table}")
  end

  # --------------------------------------------------------------------------------
  # Delete an element from a table
  # --------------------------------------------------------------------------------
  def delete(table, url, deleted = 1)
    initial_count = self.table_count(@db, table)
    @b.goto  @root_url + url
    count = self.table_count(@db, table)
    check(initial_count - count == deleted, "#{deleted} element deleted in #{table} #{url}")
  end

  # --------------------------------------------------------------------------------
  # Test basic database accesses
  # --------------------------------------------------------------------------------
  def select_one(table, where = "")
    sql = "select * from #{table}"
    if (where != "")
      sql += " WHERE #{where}"
    end
    sql += ";"
    # read all
    begin
      sth = @db.execute(sql)
      rows = sth.fetch_all
      count = rows.count

      if (count > 0)
        return rows[0]
      else
        return nill
      end

      sth.finish
    rescue DBI::DatabaseError => e
      assert(false, "Database error code=#{e.err} #{e.errstr}")
    end
  end

  # --------------------------------------------------------------------------------
  # Test basic database accesses
  # --------------------------------------------------------------------------------
  def select_last(table, where = "")
    sql = "select * from #{table}"
    if (where != "")
      sql += " WHERE #{where}"
    end
    sql += ";"
    # puts "sql=#{sql}"
    # read all
    begin
      sth = @db.execute(sql)
      rows = sth.fetch_all
      count = rows.count
      
      # puts "count=#{count}"

      if (count > 0)
        return rows[count - 1]
      else
        return nill
      end

      sth.finish
    rescue DBI::DatabaseError => e
      assert(false, "Database error code=#{e.err} #{e.errstr}")
    end
  end

  # --------------------------------------------------------------------------------
  # Return the last ID created in a table
  # --------------------------------------------------------------------------------
  def last_id(table, index=0)
    row = self.select_last(table)
    return row[index]
  end
  
  # --------------------------------------------------------------------------------
  # Basic CRUD tests
  # --------------------------------------------------------------------------------
  def crud(params)

    create = params['controller'] + '/create'
    table = params['table']

    # Create
    puts "#\tTest case: bad inputs rejected #{table} creation"
    self.fill_form(params['table'], create, params['incorrect_values'], params['error_patterns'], 0)

    puts "#\tTest case: Creation"
    self.fill_form(params['table'], create, params['values'], params['success_patterns'], 1)

    last_elt = self.select_last(params['table'])
    # puts "last_elt = " + last_elt.inspect
    id = last_elt[params['key_index']]
    edit = params['controller'] + '/edit/' + id.to_s
    delete = params['controller'] + '/delete/' + id.to_s

    # Read
    puts "#\tTest case: Read #{table}"
    edit_url = @root_url + edit
    # puts "edit_url = #{edit_url}"
    @b.goto  @root_url + edit
    
    check(@b.html.include?(params['create_pattern']), '"' + params['create_pattern'] + "\" found in form after creation in " + params['table'])

    # Update
    puts "#\tTest case: Update #{table}"
    self.fill_form(params['table'], edit, params['changes'], params['success_patterns'], 0)

    # Modification
    puts "#\tTest case: #{table} element changed"
    @b.goto  @root_url + edit
    check(@b.html.include?(params['change_pattern']), '"' + params['change_pattern'] + "\" found in form after modification" + params['table'])

    # Delete
    puts "#\tTest case: Delete #{table}"
    self.delete(params['table'], delete, 1)

  end
  
end
