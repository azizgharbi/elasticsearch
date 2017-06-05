<?php

require 'vendor/autoload.php';
//Slim
$app = new Slim\App(['settings' => ['displayErrorDetails' => true]]);
//Start
require('bootstrap.php');
//Elasticsearch
use Elasticsearch\ClientBuilder;
//Models
use Models\Event;

/*
* Routes
* POST GET PUT PATCH PUT DELETE
*/


/* HOME PAGE */
$app->get('/', function ($request, $response, $args) {
  return $this->view->render($response,'home/home.twig');
})->setName('home');

/* INDEX */
$app->get('/index', function ($request, $response, $args) {

 $hosts = ['192.168.33.10:9200'];
 $client = ClientBuilder::create()->setHosts($hosts)->build();

 $events = Event::all();

 foreach ($events as $event) {
  $params = [
    'index' => 'testindex',
    'type' => 'event',
    'id' => $event->id,
    'body' => ['title' => $event->title,'description'=> $event->description]];

   $client->index($params);
 }

  return $response->withRedirect($this->router->pathFor('home'));

})->setName('index');

/* SEARCH */
$app->get('/search', function ($request, $response, $args) {
  $key = $_GET['s'];

  $params = [
    'index' => 'testindex',
    'type' => 'event',
    'body' => ['query' => ['match' => ['description' => $key]]]];

  $hosts = ['192.168.33.10:9200'];
  $client = ClientBuilder::create()->setHosts($hosts)->build();
  $resultats = $client->search($params);
  $res = $resultats["hits"]["hits"];
  return $this->view->render($response, 'home/home.twig', ['resultats' => $res ]);

})->setName('search');

/* GENERATION */
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
