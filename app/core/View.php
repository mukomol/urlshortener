<?php
/**
 * Created by PhpStorm.
 * User: gomen
 * Date: 10/9/19
 * Time: 7:51 PM
 */

class View {

  function generate($template_view, $data = null)
  {
    $path =  CWD . '/app/view/' . $template_view . '.php';

    require  $path;
  }

}