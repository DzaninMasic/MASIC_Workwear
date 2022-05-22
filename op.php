<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'vendor/autoload.php';
require_once 'rest/dao/ProjectDao.class.php';
Flight::register('projectDao', 'ProjectDao');
Flight::route('/print', function(){
  echo "This is Dzanin \n";
});

Flight::route('GET /material', function(){
Flight::json(Flight::projectDao()->get_all());
});
Flight::start();
 ?>
