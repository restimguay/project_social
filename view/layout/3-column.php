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
    <?=Web::render_styles();?>
  </head>
  <body>
    <div class="container-fluid m-0 p-0 bg-info fixed-top shadow-sm"> 
        <div class="container">                        
            <nav class="navbar navbar-expand-sm navbar-light bg-info p-0">
                <a class="navbar-brand text-white" href="#"><?=Web::app()->name;?></a>
            </nav>
        </div>
    </div>
     
    <div class="container p-0 mt-5">
        <div class="row">
            <div class="hidden-xs hidden-sm visible-md visible-lg visible-xl col-md-3 col-lg-3 col-xl-3 bg-light">
            <?=$content_left;?>    
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <?=$content;?>
            </div>
            <div class="hidden-xs hidden-sm visible-md visible-lg visible-xl  col-md-3 col-lg-3 col-xl-3 bg-light">
            <?=$content_right;?>
            </div>
        </div>
    </div>
    <?=Web::render_scripts();?>
  </body>
</html>