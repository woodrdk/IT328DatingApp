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
//Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

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
$f3 -> route('GET|POST /personal', function($f3){
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first = $_POST['first_name'];
        $last =  $_POST['last_name'];
        $age =  $_POST['age'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
    }
    $name = $first." ".$last;
    $f3->set('name', $name);
    $f3->set('gender', $gender);
    $f3->set('phone', $phone);
    $f3->set('age', $age);

    if(validForm()){
        $_SESSION['name'] = $name;
        $_SESSION['gender'] = $_POST['gender'];
        $_SESSION['phone'] = $_POST['phone'];
        $_SESSION['age'] = $_POST['age'];
        $f3->reroute('/profile');
    }
    $view = new Template();
    echo $view->render('views/pers.html');
});
$f3 -> route('GET|POST /profile', function(){
    // var_dump($_POST);



    $view = new Template();
    echo $view->render('views/profile.html');
});

$f3 -> route('GET|POST /interests', function(){
    // var_dump($_POST);
  //   var_dump($_SESSION);
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['seeking'] = $_POST['seeking'];
    $_SESSION['bio'] = $_POST['bio'];
    $_SESSION['state'] = $_POST['state'];
    $view = new Template();
    echo $view->render('views/inter.html');
});

$f3 -> route('GET|POST /summary', function(){
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
