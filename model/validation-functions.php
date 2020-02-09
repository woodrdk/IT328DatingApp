<?php
function validForm()
{
    global $f3;
    $isValid = true;
    if (!validName($f3->get('first_name'))) {
        $isValid = false;
        $f3->set("errors['first_name']", "Please enter a valid first name");
    }
    if (!validName($f3->get('last_name'))) {
        $isValid = false;
        $f3->set("errors['last_name']", "Please enter a valid last name");
    }

    if (!validAge($f3->get('age'))) {
        $isValid = false;
        $f3->set("errors['age']", "Please enter a valid age between 18 and 118");
    }

    if (!validPhone($f3->get('phone'))){
        $isValid = false;
        $f3->set("errors['phone']", "Please enter a valid phone number.");
    }

    return $isValid;
}

// req
function validName($name) {
    return !empty($name) && ctype_alpha($name);
}
// req
function validAge($age) {
var_dump($age);
    return !empty($age)
        && ctype_digit($age)
        && $age >= 18
        && $age <= 118;
}

// req
function validPhone($phone) {
    return true;
}

// req
function validEmail($email) {
    global $f3;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $f3->set("errors['email']", "Please enter a valid email address.");
    }
    else{
        return true;
    }
}

function validInterests($selectedIndoor, $selectedOutdoor) {

    global $f3;
    return true;
}

