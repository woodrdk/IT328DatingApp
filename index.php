<?php
/*
* Rob Wood
* 1/18/2020
* This is a dating app website for class IT328
* This file routes the users at the index to the home page using FatFree Framework
*/

// start a session
session_start();
// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require the autoload file
require_once ('vendor/autoload.php');

// Create an instance of the base class
$f3 = Base::instance();

// define a default route
$f3 -> route('GET /', function(){
    $view = new Template();
    echo $view->render('views/home.html');
    //echo'<h1>Hello World!</h1>';
});

$f3 -> route('GET /order', function(){
    $view = new Template();
    echo $view->render('views/form1.html');
});
$f3 -> route('POST /order2', function(){
    // var_dump($_POST);
    $_SESSION['food'] = $_POST['food'];
    $view = new Template();
    echo $view->render('views/form2.html');
});
// Run Fat Free
$f3 -> run();
