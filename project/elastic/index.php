<?php

require 'vendor/autoload.php';
$app = new Slim\App(['settings' => ['displayErrorDetails' => true]]);
require('bootstrap.php');
use \Elastica\Request as Request;
use \Elastica\Client as Client;

use Models\Event;
/*
* Start app
*/

$app->get('/', function ($request, $response, $args) {
  return $this->view->render($response,'home/home.twig');
})->setName('home');



$app->get('/test', function ($request, $response, $args) {


$elasticaClient = new Client(array(
    'host' => 'localhost.elastic.test.com',
    'port' => 9200
));

})->setName('test');




$app->get('/data', function ($request, $response, $args) {
 for ($i=0; $i < 21 ; $i++) {
   $faker = Faker\Factory::create();
   Event::create([
      'title'=>$faker->name,
      'description'=> $faker->text
    ]);
 }
 return $response->withRedirect($this->router->pathFor('home'));
})->setName('generate');


/*start application*/

$app->run();
