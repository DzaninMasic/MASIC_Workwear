<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

  require_once 'ButtonsDao.class.php';
  require_once 'ThreadsDao.class.php';
  require_once 'VelcroDao.class.php';
  require_once 'ZippersDao.class.php';

  //$threadsDao = new ThreadsDao();
  //$buttonsDao = new ButtonsDao();
  $zippersDao = new ZippersDao();
  $zippers=$zippersDao->get_all_zippers();
  print_r($zippers);

  //$threads=$threadsDao->get_all_threads();
  //print_r($threads);

  //$buttons=$buttonsDao->get_all_buttons();
  //$buttonsByName=$buttonsDao->get_button_by_name('Biteks');
  //print_r($buttonsByName);

 ?>
