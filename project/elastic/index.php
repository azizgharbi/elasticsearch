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

$app->get('/', function ($request, $response, $args) {
  return $this->view->render($response,'home/home.twig');
})->setName('home');


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


$app->get('/search', function ($request, $response, $args) {
  $key = $_GET['s'];
  $params = [
    'index' => 'testindex',
    'type' => 'event',
    'body' => ['query' => ['match' => ['description' => $key]]]];

  $hosts = ['192.168.33.10:9200'];
  $client = ClientBuilder::create()->setHosts($hosts)->build();
  $rep = $client->search($params);
  var_dump($rep);

})->setName('search');

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
