<?php
define('started',true);
session_start();
require 'Web.php';
use helper\Web;

$config = array_merge(
    require './config/main.php',
    require './config/settings.php'
);;
Web::init($config);
//-- jQuery first, then Popper.js, then Bootstrap JS
Web::register_script('asset/js/jquery-3.3.1.js');
Web::register_script('asset/js/popper.min.js');
Web::register_script('asset/js/bootstrap.min.js');

//https://fonts.googleapis.com/css?family=Varela+Round
Web::register_style('asset/css/fonts.googleapis.family.varela_round.css');
//http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css
//Web::register_style('asset/css/font-awesome.min.css');
Web::register_style('http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css');
https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css
Web::register_style('asset/css/bootstrap.min.css');
// our custom style
Web::register_style('asset/css/index.css');