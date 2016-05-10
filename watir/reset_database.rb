# ReInitialize the database to a known state
require File.dirname(__FILE__) + '/dbBackup.rb'

module ResetDatabase
  
  @database = 'ci3'  
  @bckp = DbBackup.new(:user => 'ci3', :password => 'ci3', :database => @database)
  
  @filename = File.dirname(__FILE__) + '/database_1.sql'
  @bckp.drop
  @bckp.create(@database)
  
  @bckp.restore(@filename)
  puts "# database #{@filename} reloaded"
 
  def ResetDatabase.drop
    @bckp.drop
  end

  def ResetDatabase.create
    @bckp.create(@database)
  end
  
  def ResetDatabase.restore
    @bckp.restore(@filename)
  end

end

