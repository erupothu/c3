<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7.
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group 	= $_SERVER['HTTP_HOST'];
$active_record 	= true;

$db['cms.insight']['hostname'] = 'localhost';
$db['cms.insight']['username'] = 'cms_demo';
$db['cms.insight']['password'] = 'DBDmQQRRJyrC9PXH';
$db['cms.insight']['database'] = 'creativeinsight_demo_cms';
$db['cms.insight']['dbdriver'] = 'mysqli';
$db['cms.insight']['dbprefix'] = '';
$db['cms.insight']['pconnect'] = true;
$db['cms.insight']['db_debug'] = true;
$db['cms.insight']['cache_on'] = false;
$db['cms.insight']['cachedir'] = '';
$db['cms.insight']['char_set'] = 'utf8';
$db['cms.insight']['dbcollat'] = 'utf8_general_ci';
$db['cms.insight']['swap_pre'] = '';
$db['cms.insight']['autoinit'] = true;
$db['cms.insight']['stricton'] = false;

$db['cms.ciclients.com']['hostname'] = 'localhost';
$db['cms.ciclients.com']['username'] = 'clients_cms_demo';
$db['cms.ciclients.com']['password'] = 'DBDmQQRRJyrC9PXH';
$db['cms.ciclients.com']['database'] = 'clients_cms_demo';
$db['cms.ciclients.com']['dbdriver'] = 'mysqli';
$db['cms.ciclients.com']['dbprefix'] = '';
$db['cms.ciclients.com']['pconnect'] = true;
$db['cms.ciclients.com']['db_debug'] = true;
$db['cms.ciclients.com']['cache_on'] = false;
$db['cms.ciclients.com']['cachedir'] = '';
$db['cms.ciclients.com']['char_set'] = 'utf8';
$db['cms.ciclients.com']['dbcollat'] = 'utf8_general_ci';
$db['cms.ciclients.com']['swap_pre'] = '';
$db['cms.ciclients.com']['autoinit'] = true;
$db['cms.ciclients.com']['stricton'] = false;