<?php
/*
 * This class will allow users to create sign up member objects
 *
 */
class Member
{
    private $_ID;
    private $_fname;
    private $_lname;
    private $_age;
    private $_gender;
    private $_phone;
    private $_email;
    private $_state;
    private $_seeking;
    private $_bio;


    /**
     * Member constructor.
     * @param $_fname user's first name
     * @param $_lname user's last name
     * @param $_age user's age
     * @param $_gender user's gender
     * @param $_phone user's phone num
     */
    public function __construct($_fname, $_lname, $_age, $_gender, $_phone)
    {
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_age = $_age;
        $this->_gender = $_gender;
        $this->_phone = $_phone;
        // $this->_email = $_email;
        // $this->_state = $_state;
        // $this->_seeking = $_seeking;
        // $this->_bio = $_bio;
    }
    /*
     * Returns what type of membership user has
     * @return String of the type of membership
     */
    public function memberType()
    {
        return "member";
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_ID;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->_ID = $id;
    }

    /**
     * @return the user's first name
     */
    public function getFname()
    {
        return $this->_fname;
    }

    /**
     * sets the users first name
     * @param mixed $fname
     */
    public function setFname($fname)
    {
        $this->_fname = $fname;
    }

    /**
     * @return user's last name
     */
    public function getLname()
    {
        return $this->_lname;
    }

    /**
     * sets the user's last name
     * @param mixed $lname
     */
    public function setLname($lname)
    {
        $this->_lname = $lname;
    }

    /**
     * @return user's age
     */
    public function getAge()
    {
        return $this->_age;
    }

    /**
     * sets the user's age
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->_age = $age;
    }

    /**
     * @return user's gender
     */
    public function getGender()
    {
        return $this->_gender;
    }

    /*
     * sets the user's gender
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->_gender = $gender;
    }

    /**
     * @return user's phone number
     */
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * sets the user's phone number
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->_phone = $phone;
    }

    /**
     * @return user's email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * sets the user's email
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @return user's state
     */
    public function getState()
    {
        return $this->_state;
    }

    /**
     * sets user's state
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->_state = $state;
    }

    /**
     * @return gender user is seeking
     */
    public function getSeeking()
    {
        return $this->_seeking;
    }

    /**
     * sets the gender the user is seeking
     * @param mixed $seeking
     */
    public function setSeeking($seeking)
    {
        $this->_seeking = $seeking;
    }

    /**
     * @return user's bio
     */
    public function getBio()
    {
        return $this->_bio;
    }

    /**
     * sets the user's bio
     * @param mixed $bio
     */
    public function setBio($bio)
    {
        $this->_bio = $bio;
    }


}