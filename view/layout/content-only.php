<?php

use helper\Web;



?>
<!doctype html>
<html lang="en">
  <head>
    <title><?=Web::app()->name;?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <?=Web::render_styles();?>
  </head>
  <body>
     <?=$content;?>
    <?=Web::render_scripts();?>
  </body>
</html>