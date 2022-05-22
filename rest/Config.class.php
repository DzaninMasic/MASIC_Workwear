<?php

  class Config{
    public static function JWT_SECRET(){
      return Config::get_env("JWT_SECRET","gwanxsaiw");
    }
    public static function get_env($name, $default){
      return isset($_ENV[$name]) && trim($_ENV[$name]) != '' ? $_ENV[$name] : $default;
    }
  }

 ?>
