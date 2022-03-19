<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php';
require_once 'rest/dao/ProjectDao.class.php';
require_once 'rest/dao/AdminsDao.class.php';
require_once 'rest/dao/ButtonsDao.class.php';
require_once 'rest/dao/ThreadsDao.class.php';
require_once 'rest/dao/VelcroDao.class.php';

Flight::route('/', function(){
  $dao = new ProjectDao();
  $admins = new AdminsDao();
  $buttons = new ButtonsDao();
  $threads = new ThreadsDao();
  $velcro = new VelcroDao();
  $velcro->add($_REQUEST['name'], $_REQUEST['color'], $_REQUEST['type'], $_REQUEST['length'], $_REQUEST['available']);
  die;
  //$threads->add($_REQUEST['code'], $_REQUEST['name'], $_REQUEST['color'], $_REQUEST['length'], $_REQUEST['amount'], $_REQUEST['width'], $_REQUEST['available']);
  $getThreads=$threads->get_all_threads();
  print_r($getThreads);
  die;

  $op = $_REQUEST['op'];

  switch ($op) {
    case 'add':
      $dao->add($_REQUEST['name'], $_REQUEST['color'], $_REQUEST['length'], $_REQUEST['available']);
      break;

    case 'delete':
      $dao->delete($_REQUEST['id']);
      echo "DELETED $id";
      break;

    case 'update':
      $dao->update($_REQUEST['id'],$_REQUEST['name'], $_REQUEST['color'], $_REQUEST['length'], $_REQUEST['available']);
      echo "UPDATED $id";
      break;

    case 'get':
    default:
      $result = $dao->get_all();
      print_r($result);
  }

  echo "done";
});
Flight::start();
 ?>
