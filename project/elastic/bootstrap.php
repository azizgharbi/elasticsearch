<?php

use Config\Database ;

$database = new Database();
$container = $app->getContainer();
// Add Twig template to slim
$container['view'] = function ($container) {
  $view = new \Slim\Views\Twig('views');
  $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
  $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
  return $view;
};
