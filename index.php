<?php

function getPath ($el){
  $pathArr = preg_split('/[.]/' , $el);
  return $pathArr;
}

function check($el , $defaultEl )
{
    if ($el){
        echo "$el" . "<br>";
        return $el;
    }
    else if ($defaultEl) {
      echo "$defaultEl" . "<br>";
      return $defaultEl;
    }
    else {
        throw new Exception('Данного свойства нет в файле настроек!');
    }
}

function config($call , $defaultValue = null) {
  $path = getPath($call);
  $settings = require 'settings.php';
  if (count($path) > 1) {
    $index = count($path) - 1;
    $i = 0;
    $deepSearch = $settings[$path[$i]];
    for (; $index > 0; $index--){
      $i++;
      $deepSearch = $deepSearch[$path[$i]];
    }
    check($deepSearch , $defaultValue);

  }
  else {
    check($settings[$call] , $defaultValue) . "<br>";
  }
}
