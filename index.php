<?php
/*
* Rob Wood
* 1/18/2020
* This is a dating app website for class IT328
* This file routes the users at the index to the home page using FatFree Framework
*/

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require the autoload file
require_once ('vendor/autoload.php');
require ('model/validation-functions.php');
// start a session
session_start();
// Create an instance of the base class
$f3 = Base::instance();
//Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);
$controller = new MemberController($f3);

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
$f3 -> route('GET /', function($f3){
    $GLOBALS['controller']->home();
});

// personal info, profile, interests,  profile summary
$f3 -> route('GET /home', function($f3){
    $GLOBALS['controller']->home();
});

$f3 -> route('GET|POST /personal', function($f3){
    $GLOBALS['controller']->personal();
});

$f3 -> route('GET|POST /profile', function($f3){
    $GLOBALS['controller']->profile();
});

$f3 -> route('GET|POST /interests', function($f3){
    $GLOBALS['controller']->interests();
});

$f3 -> route('GET|POST /summary', function(){
    $GLOBALS['controller']->summary();
});
$f3 -> route('GET|POST /pic', function(){
    $GLOBALS['controller']->pic();
});

$f3 -> route('GET /privacy', function(){
    $GLOBALS['controller']->privacy();
});

// Run Fat Free
$f3 -> run();
