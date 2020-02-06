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
require ('model/validation-functions.php');
// Create an instance of the base class
$f3 = Base::instance();

// define a default route
$f3 -> route('GET /', function(){
    $view = new Template();
    echo $view->render('views/home.html');
    //echo'<h1>Hello World!</h1>';
});
// personal info, profile, interests,  profile summary
$f3 -> route('GET /home', function(){
    $view = new Template();
    echo $view->render('views/home.html');
});
$f3 -> route('GET /personal', function(){
    $view = new Template();
    echo $view->render('views/pers.html');
});
$f3 -> route('POST /profile', function(){
    // var_dump($_POST);
    $name = $_POST['first_name']." ".$_POST['last_name'];
    $_SESSION['name'] = $name;
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['phone'] = $_POST['phone'];
    $_SESSION['age'] = $_POST['age'];

    $view = new Template();
    echo $view->render('views/profile.html');
});

$f3 -> route('POST /interests', function(){
    // var_dump($_POST);
  //   var_dump($_SESSION);
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['seeking'] = $_POST['seeking'];
    $_SESSION['bio'] = $_POST['bio'];
    $_SESSION['state'] = $_POST['state'];
    $view = new Template();
    echo $view->render('views/inter.html');
});

$f3 -> route('POST /summary', function(){
     // var_dump($_POST);
    //var_dump($_POST['interests']);
   // $_SESSION['interests'][] = $_POST['interests'];
    $_SESSION["result"] = "";
    $count = 0;
    if($_POST['interests'] > 0){
        foreach ($_POST['interests'] as $result){
            if($count > 0){
                $_SESSION["result"] .= ", ".$result;
            }
            else{
                $_SESSION["result"] .= " ".$result;
                $count++;
            }
        }
    }
    $view = new Template();
    echo $view->render('views/summ.html');
});


$f3 -> route('GET /privacy', function(){
    $view = new Template();
    echo $view->render('views/privacy.html');
});
// Run Fat Free
$f3 -> run();
