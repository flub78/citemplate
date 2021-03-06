# encoding: utf-8
# GVV Watir test
#
# Test le support des langues Anglais et Néerlandais.
#
# Pour le moment, le test prend juste une copie d'écran de la page d'acceuil
# et sort correctement si le boutton de sortie est traduit.
#
# Questions: 
#   Est-ce qu'il faudrait tester tout le fonctionnale dans chaque langue ?
#   c-a-d multiplier par 3 les temps d'exécution.
#   Cela démontrerai que le programme n'est pas dépendant des chaines en dur. 
#
#   Est-ce qu'il faudrait tester toutes les chaines affichées?
#   Non le contrôle visuel est suffisant.
#
#   Réponse: les deux propositions sont assez chères. Une fois qu'on a démontré qu'on savait
#            changer de langue et que le programme fonctionne dans au moins une langue et qu'on a fait
#            du contrôle visuel de chaque langue, on a déjà pas mal testé.
#
#
require 'dbi'
require './php_config.rb'
require './application_test.rb'

class TestInternational < ApplicationTest
  
  # --------------------------------------------------------------------------------
  # Run before every test
  # --------------------------------------------------------------------------------
  def setup
    super
    self.db_connect
  end

  # --------------------------------------------------------------------------------
  # Executed after each test
  # --------------------------------------------------------------------------------
  def teardown
    self.db_disconnect
    super
  end


  # --------------------------------------------------------------------------------
  # Set the language
  # --------------------------------------------------------------------------------
  def set_language(lang)
    
    configfile = '../application/config/config.php'
    conf = PhpConfig.new(configfile)
    assert(conf, "configuration loaded")
    
    # puts "keys = #{conf.keys}"
    
    conf.set('language', "'#{lang}'")    
    conf.save
    # Reload 
    conf = PhpConfig.new(configfile)
    assert(conf.value('language') == "'#{lang}'", 'language set to ' + "'#{lang}'")       
  end
  
  # --------------------------------------------------------------------------------
  # Test of GVV in english
  # --------------------------------------------------------------------------------
  def test_english
    
    description('pages are displayed in English', 'English is set in config file')

    puts "#\tTest case: English"
    self.set_language('english')
    self.login('admin', 'admin')
    
    @b.goto @root_url
    
    screenshot('lang_english.png')
    # puts @b.text
    check(@b.html.include?('Logout'), 'Logout button in english')
    
    self.logout
    self.set_language('english')

  end

  # --------------------------------------------------------------------------------
  # Test of French version
  # --------------------------------------------------------------------------------
  def test_french
    
    description('pages are displayed in French', 'French is set in config file')
    self.set_language('french')
    self.login('admin', 'admin')
    
    @b.goto @root_url
    check(@b.html.include?('Sortie'), 'Logout button in french')

    screenshot('lang_french.png')
    
    self.logout
    
    self.set_language('english')

  end
          
end
