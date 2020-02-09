<?php
// checks if the profile form is legit data
function validForm()
{
    global $f3;
    $isValid = true;
    // checks first name if false sets error
    if (!validName($f3->get('first_name'))) {
        $isValid = false;
        $f3->set("errors['first_name']", "Please enter a valid first name");
    }
    // checks last name if false sets error
    if (!validName($f3->get('last_name'))) {
        $isValid = false;
        $f3->set("errors['last_name']", "Please enter a valid last name");
    }
    // checks age if false sets error
    if (!validAge($f3->get('age'))) {
        $isValid = false;
        $f3->set("errors['age']", "Please enter a valid age between 18 and 118");
    }
    // checks phone if false sets error
    if (!validPhone($f3->get('phone'))){
        $isValid = false;
        $f3->set("errors['phone']", "Please enter a valid phone number.");
    }

    return $isValid;
}

// checks if name is not empty and only letters
function validName($name) {
    return !empty($name) && ctype_alpha($name);
}

// checks if age is not empty and only numbers between 18 and 118
function validAge($age) {
    //var_dump($age);
    return !empty($age)
        && ctype_digit($age)
        && $age >= 18
        && $age <= 118;
}

// checks phone number is only numbers
function validPhone($phone) {
    //$phone = preg_replace("/[^0-9]/", "", $phone);
    return preg_match('/^[0-9]{10}+$/', $phone);
}

// checks if the email is valid email address and returns error if it fails
function validEmail($email) {
    global $f3;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $f3->set("errors['email']", "Please enter a valid email address.");
    }
    else{
        return true;
    }
}
// checks if interests are valid
function validInterests($selectedIndoor, $selectedOutdoor) {
    global $f3;
    //var_dump( $selectedIndoor);
    $isvalid = true;
    if(!indoorInterests($selectedIndoor)){
        $isvalid = false;
    }
    if(!outdoorInterests($selectedOutdoor)){
        $isvalid = false;
    }
    return $isvalid;
}

// verifies indoor interests are valid and sets errors if not
function  indoorInterests($selectedIndoor){
    $indoor = array('tv', 'puzzles', 'movies', 'video games', 'board games', 'playing cards', 'cooking', 'reading');
    global $f3;
    $isvalid = true;
    if(count(array_intersect($selectedIndoor, $indoor)) != sizeof($selectedIndoor)){
        $f3->set("errors['indoorI']", "Please choose a valid indoor interest.");
        $isvalid = false;
    }

    return $isvalid;
}

// verifies outdoor interests are valid and sets errors if not
function outdoorInterests( $selectedOutdoor){
    $outdoor = array ('collecting', 'climbing', 'swimming',
        'biking', 'walking', 'hiking');
    global $f3;
    $isvalid = true;
    var_dump($selectedOutdoor);
    if(count(array_intersect($selectedOutdoor, $outdoor)) != sizeof($selectedOutdoor)){
        $f3->set("errors['outdoorI']", "Please choose a valid outdoor interest.");
        $isvalid = false;
    }
    return $isvalid;
}


