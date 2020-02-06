<?php
function validForm()
{
    global $f3;
    $isValid = true;
    if (!validName($f3->get('name'))) {
        $isValid = false;
        $f3->set("errors['name']", "Please enter a valid name");
    }

    if (!validAge($f3->get('age'))) {
        $isValid = false;
        $f3->set("errors['age']", "Please enter a valid age between 18 and 118");
    }

    if (!validPhone($f3->get('phone'))){
        $isValid = false;
        $f3->set("errors['phone']", "Please enter a valid phone number.");
    }

    if (!validEmail($f3->get('email'))) {
        $isValid = false;
        $f3->set("errors['email']", "Please enter a valid email address");
    }
    return $isValid;
}


// req
function validName($name) {
    return !empty($name) && ctype_alpha($name);
}
// req
function validAge($age) {
    return !empty($age)
        && ctype_digit($age)
        && $age >= 18
        && $age <= 118;
}

// req
function validPhone($phone) {

}

// req
function validEmail($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo("$email is a valid email address");
    } else {
        echo("$email is not a valid email address");
    }
}

function validOutdoor($outdoor) {

}

function validIndoor($indoor) {

}