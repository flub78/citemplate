CITEMPLATE
==========

CITEMPLATE is a project framework for CodeIgniter >= 3 

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
