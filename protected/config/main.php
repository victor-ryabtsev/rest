<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
  'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
  'name' => 'My Web Application',
	// preloading 'log' component
  'preload' => array('log'),
	// autoloading model and component classes
  'import' => array(
	'application.models.*',
	'application.components.*',
	'application.components.json.*',
	'application.components.json.exceptions.*',
  ),
  'modules' => array(
	  // uncomment the following to enable the Gii tool

	'gii' => array(
	  'class' => 'system.gii.GiiModule',
	  'password' => '1234',
		// If removed, Gii defaults to localhost only. Edit carefully to taste.
	  'ipFilters' => array('127.0.0.1', '::1'),
	),
	'api',
  ),
	// application components
  'components' => array(
	'user' => array(
		// enable cookie-based authentication
	  'allowAutoLogin' => TRUE,
	),
	  // uncomment the following to enable URLs in path-format

	'urlManager' => array(
	  'urlFormat' => 'path',
	  'showScriptName' => FALSE,
	  'rules' => array(
		array('api/user/list', 'pattern' => 'api/users', 'verb' => 'GET'),
		array('api/user/view', 'pattern' => 'api/user/<id:\d+>', 'verb' => 'GET'),
		array('api/user/create', 'pattern' => 'api/user', 'verb' => 'POST'),
		array('api/user/update', 'pattern' => 'api/user/<id:\d+>', 'verb' => 'PUT'),
		array('api/user/delete', 'pattern' => 'api/user/<id:\d+>', 'verb' => 'DELETE'),
		'<controller:\w+>/<id:\d+>' => '<controller>/view',
		'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
		'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
	  ),
	),
	  /*'db'=>array(
		'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
	),*/
	  // uncomment the following to use a MySQL database

	'db' => array(
	  'connectionString' => 'mysql:host=localhost;dbname=rest',
	  'emulatePrepare' => TRUE,
	  'username' => 'rest',
	  'password' => 'rest',
	  'charset' => 'utf8',
	),
	'request' => array(
	  'class' => 'application.components.rest.RestCHttpRequest',
	),
	'errorHandler' => array(
		// use 'site/error' action to display errors
	  'errorAction' => 'site/error',
	),
	'log' => array(
	  'class' => 'CLogRouter',
	  'routes' => array(
		array(
		  'class' => 'CFileLogRoute',
		  'levels' => 'error, warning',
		),
		  // uncomment the following to show log messages on web pages
		  /*
		array(
			'class'=>'CWebLogRoute',
		),
		*/
	  ),
	),
  ),
	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
  'params' => array(
	  // this is used in contact page
	'adminEmail' => 'webmaster@example.com',
  ),
);