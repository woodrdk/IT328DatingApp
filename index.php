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


// define arrays
$f3->set('genders', array('Male', 'Female', 'Other'));
$f3->set('states', array('Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
    'Colorado', 'Connecticut','Delaware','District Of Columbia', 'Florida',
    'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana',
    'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine',
    'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi',
    'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
    'New Jersey', 'New Mexico', 'New York' ,'North Carolina', 'North Dakota',
    'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
    'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah' , 'Vermont',
    'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'));

$indoor = array('tv', 'puzzles', 'movies', 'video games', 'board games', 'playing cards', 'cooking', 'reading');
$f3->set('indoor', $indoor);
$outdoor = array ('collecting', 'climbing', 'swimming',
    'biking', 'walking', 'hiking');
$f3->set('outdoor', $outdoor);

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
        //var_dump($_POST);
        $first = $_POST['first_name'];
        $last =  $_POST['last_name'];
        $age =  trim($_POST['age']);
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $name = $first." ".$last;

        $f3->set('first_name', $first);
        $f3->set('last_name', $last);
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
    }
    $view = new Template();
    echo $view->render('views/pers.html');

});
$f3 -> route('GET|POST /profile', function($f3){
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Get data from form
        $email = $_POST['email'];
        $state = $_POST['state'];
        $seek = $_POST['seeking'];
        $bio = $_POST['bio'];

        //Add data to hive
        $f3->set('email', $email);
        $f3->set('stateOption', $state);
        $f3->set('seek', $seek);
        $f3->set('bio', $bio);

        //If data is valid
        if (validEmail($email)) {
            //Write data to Session
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['seeking'] = $_POST['seeking'];
            $_SESSION['bio'] = $_POST['bio'];
            $_SESSION['state'] = $_POST['state'];            //Redirect to Summary
            $f3->reroute('/interests');
        }
    }

    $view = new Template();
    echo $view->render('views/profile.html');
});

$f3 -> route('GET|POST /interests', function($f3, $indoor, $outdoor){

    $selectedIndoor = array();
    $selectedOutdoor = array();
    //If form has been submitted, validate
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Get data from form

        if(!empty($_POST['indoorInterests'])){
            $selectedIndoor = $_POST['indoorInterests'];
        };
        if(!empty($_POST['outdoorInterests'])){
            $selectedOutdoor = $_POST['outdoorInterests'];
        };


        //Add data to hive
        $f3->set('selectedIndoor', $selectedIndoor);
        $f3->set('selectedOutdoor', $selectedOutdoor);

        //If data is valid
        if (validInterests($selectedIndoor, $selectedOutdoor )) {
            //Write data to Session
            $_SESSION['inDoor'] = $selectedIndoor;
            $_SESSION['outDoor'] = $selectedOutdoor;
           //Redirect to Summary
            $f3->reroute('/summary');
        }
    }
    $view = new Template();
    echo $view->render('views/inter.html');
});

$f3 -> route('GET|POST /summary', function(){
    $view = new Template();
    echo $view->render('views/summ.html');
});

$f3 -> route('GET /privacy', function(){
    $view = new Template();
    echo $view->render('views/privacy.html');
});
// Run Fat Free
$f3 -> run();
