<?php

$app = require_once __DIR__ . '/app/bootstrap.php';

use Model\DataView\DataView;
use Model\Shortener\Shortener;

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

session_start();
?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>URL Shortener</title>
        <link rel="stylesheet" href="public/css/global.css">
    </head>
    <body>
    <div class="container">
        <h1 class="title">Shorten a URL.</h1>
      <?php
      if (isset($_SESSION['feedback'])) {
        echo "<p>{$_SESSION['feedback']}</p>";
        unset($_SESSION['feedback']);
      }
      ?>
        <form action="shorten.php" method="post">
            <input type="url" name="url" placeholder="Enter a URL here." autocomplete="off" value="">
            <input type="submit" value="Shorten">
        </form>
    </div>
    </body>
    </html>
<?php
if (!isset($_SESSION)) { session_start(); }

if ($_GET) {
  $key = array_keys($_GET);
  $dv = new DataView();
  if (strpos($key[0], '_')) {
    $getData = $dv->getStats($key[0]);
    echo $getData;
    header("Location: http://$host/shortener");
  }
  else {
    $dv->writeStats($_SERVER['REMOTE_ADDR'], $key[0]);
    $s = new Shortener();
    $url = $s->getUrl($key[0]);
    header("Location: " . $url);
  }

}
