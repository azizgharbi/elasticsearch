<?php

namespace Config;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database {
	function __construct(){
	$capsule = new Capsule;
	$capsule->addConnection([
	    'driver'    => "mysql",
	    'host'      => "localhost",
	    'database'  => "elastic",
	    'username'  => "root",
	    'password'  => "aziz",
	    'charset'   => 'utf8',
	    'collation' => 'utf8_unicode_ci',
	    'prefix'    => '',
	]);
	// Run Elequent
	$capsule->bootEloquent();
	}
}
