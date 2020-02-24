<?php

class MemberController
{
    private $_f3;

    public function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    public function home()
    {

        $template = new Template();
        echo $template->render('views/home.html');
    }

    public function personal()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $first = $_POST['first_name'];
            $last =  $_POST['last_name'];
            $age =  trim($_POST['age']);
            $gender = $_POST['gender'];
            $phone = $_POST['phone'];
            $name = $first." ".$last;

            $this->_f3->set('first_name', $first);
            $this->_f3->set('last_name', $last);
            $this->_f3->set('gender', $gender);
            $this->_f3->set('phone', $phone);
            $this->_f3->set('age', $age);

            if(validForm()){
                if(isset($_POST['prem'])){
                    $member = new PremiumMember($first, $last, $age, $gender, $phone);
                }
                else{
                    $member = new Member($first, $last, $age, $gender, $phone);
                }
                $_SESSION['member'] = $member;
                $this->_f3->reroute('/profile');
            }
        }
        $view = new Template();
        echo $view->render('views/pers.html');
    }

    public function profile()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Get data from form
            $email = $_POST['email'];
            $state = $_POST['state'];
            $seek = $_POST['seeking'];
            $bio = $_POST['bio'];

            //Add data to hive
            $this->_f3->set('email', $email);
            $this->_f3->set('stateOption', $state);
            $this->_f3->set('seek', $seek);
            $this->_f3->set('bio', $bio);

            $member = $_SESSION['member'];
            //If data is valid
            if (validEmail($email)) {
                $member->setEmail($email);
                $member->setSeeking($_POST['seeking']);
                $member->setBio($_POST['bio']);
                $member->setState($_POST['state']);
                $_SESSION['member'] = $member;

                /*$_SESSION['email'] = $_POST['email'];
                $_SESSION['seeking'] = $_POST['seeking'];
                $_SESSION['bio'] = $_POST['bio'];
                $_SESSION['state'] = $_POST['state'];
                           //Redirect to Summary*/
                if($member->memberType() == "member") {
                    $this->_f3->reroute('/summary');
                } else {
                    $this->_f3->reroute('/interests');
                }
            }
        }

        $view = new Template();
        echo $view->render('views/profile.html');
    }

    public function interests()
    {
        $selectedIndoor = array();
        $selectedOutdoor = array();
        //If form has been submitted, validate
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Get data from form

            if(!empty($_POST['indoorInterests'])){
                $selectedIndoor = $_POST['indoorInterests'];
                //Add data to hive
                $this->_f3->set('selectedIndoor', $selectedIndoor);
            };
            if(!empty($_POST['outdoorInterests'])){
                $selectedOutdoor = $_POST['outdoorInterests'];
                $this->_f3->set('selectedOutdoor', $selectedOutdoor);
            };
            $member = $_SESSION['member'];
            //If data is valid
            if (validInterests($selectedIndoor, $selectedOutdoor )) {
                //Write data to Session
                $member->setInDoorInterests($selectedIndoor);
                $member->setOutDoorInterests($selectedOutdoor);
                // $_SESSION['inDoor'] = $selectedIndoor;
                // $_SESSION['outDoor'] = $selectedOutdoor;
                //Redirect to Summary
                $this->_f3->reroute('/pic');
            }
        }
        $view = new Template();
        echo $view->render('views/inter.html');
    }

    public function pic()
    {
        $view = new Template();
        echo $view->render('views/pic.html');
    }

    public function summary()
    {
        $view = new Template();
        echo $view->render('views/summ.html');
    }

    public function privacy()
    {
        $view = new Template();
        echo $view->render('views/privacy.html');
    }
}