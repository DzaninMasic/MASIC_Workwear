<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  require_once 'C:\xampp\htdocs\MASIC_Workwear\vendor\autoload.php';
  require_once 'C:\xampp\htdocs\MASIC_Workwear\rest\services\MaterialService.class.php';
  require_once 'C:\xampp\htdocs\MASIC_Workwear\rest\services\ColorsService.class.php';
  require_once 'C:\xampp\htdocs\MASIC_Workwear\rest\dao\AdminsDao.class.php';

  Flight::register('adminsDao', 'AdminsDao');
  Flight::register('materialService', 'MaterialService');
  Flight::register('colorsService', 'ColorsService');
  Flight::register('adminService', 'AdminService');

  require_once 'C:\xampp\htdocs\MASIC_Workwear\rest\routes\ColorRoutes.php';
  require_once 'C:\xampp\htdocs\MASIC_Workwear\rest\routes\MaterialRoutes.php';
  require_once 'C:\xampp\htdocs\MASIC_Workwear\rest\routes\AdminRoutes.php';
  Flight::start();
?>
