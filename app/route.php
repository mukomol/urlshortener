<?php

use Model\Shortener\Shortener;

$router = new Router();

$router->add_route('/', function(){
  require_once 'view/main.php';
});

$router->add_route('/callback', 'shorten');

function shorten(){

  $s = new Shortener();

  if(isset($_POST['url'])){
    $url = $_POST['url'];
    $_SESSION['feedback'] ='';
    if($code = $s->makeCode($url)){
      $_SESSION['feedback'] .= "Generated! Your short URL is: <a href=\"http://localhost/shortener/?{$code}\">http://localhost/shortener/?{$code}</a>";
      $_SESSION['feedback'] .= "Check stats URL is: <a href=\"http://localhost/shortener/?_{$code}\">http://localhost/shortener/?_{$code}</a>";
    }else{
      $_SESSION['feedback'] = " There was a problem. Invalid URL, perhaps?";
    }
  }

  require_once 'view/main.php';
}

$router->execute();