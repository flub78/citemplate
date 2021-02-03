CITEMPLATE
==========

CITEMPLATE is a project framework for CodeIgniter >= 3 

(Projet abandonné), remplacé par la même chose basé sur WEBAPP et le framework Laravel.

It includes:
* an installation procedure
* Bootstrap for adaptaion to multiple screen format and menu management
* Jquery to manage browsers specificities and provide an easy Javascript syntax
* datatable Jquery module
* fullCalendar Juery module
* database backup and restore
* Authentication using ion-auth
* phnunit tests
* WATIR tests
* Some REST API and client examples

The idea is to put together the structure of a WEB application, that could be used at a starting point to develop real WEB applications.

Development principles:

* The project is fanatically DRY (do not repeat yourself). It is based on a generic controller and model from which are derived the actual controllers and models. Most simple functions can be derived from these controller and model without requiring additional code.
* It is based on metadata, the program uses the database meta information to determine how to generate input fields or to display data. When the data contained into the database is not enough additional subtypes are managed (email is a subtype of varchar, currency is a subtype of decimal, etc)
* Most of the complex database queries are stored directly into the database as views. That way complex processing can be performed by a relatively simple program.

Git repo
--------

  [https://github.com/flub78/citemplate]
  
Installation
------------

* upload the project in one WEB server directory
* create a Mysql database
* edit application/config/config.php to define the base URL
* edit application/config/database.php to define the database access parameters

Currently the creation of the uploads/restore directory is not automatic. Do it manually.

Access to the application, the installation is automatic. If the program detects that the installation has not been done, it triggers the process. 

Tests
-----

Testing is done at two level: unit tests using PHPUNIT for which the objective is a good code coverage. These tests should call the code both in correct and erroneous ways. There is also end to end, by controlling a WEB browser with ruby scripts using the WATIR framework. For these tests the objective is a good feature coverage including installation, backup and recovery, etc.

The PHPUnit tests uses the Agile documentation feature and a short description of the test cases is generated in HTML format. WATIR tests are self documented, and youshould be able to understand the test cases from their output. 

To run the unit tests:
    
    cd application/tests
    phpunit
    
    In this case the coverage analysis may be found in application/tests/build/coverage/index.html
    
    # to run one unit test
    phpunit helpers/Helper_metadata_test.php
    

To run the watir tests:

    cd watir
    source setenv.sh
    
    # to run one test
    ruby test_template.rb
    
    # to run all tests
    rake test
    
    # to clean the test results
    rake clean
    
    
