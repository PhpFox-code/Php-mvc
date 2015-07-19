<?php 
  ini_set('display_errors','On');

  include ('config.php');
  $dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
 
  include (SITE_PATH . DS . 'core' . DS . 'core.php'); 
  $str = SITE_PATH. DS.'controllers';

  // Запустить роутер
  $router = new Router();
  $router->start();


?> 

