<?php

require_once ("config-member.php");

/*
 * Ran out of time to correct my database but this is one that i used last.. redid this several times then realized
 * was still wrong
CREATE TABLE member(
    member_id INT AUTO_INCREMENT,
    fname VARCHAR(255) NULL,
    lname VARCHAR(255) NULL,
    age INT NULL,
    gender VARCHAR(255) NULL,
    phone VARCHAR(255) NULL,
    email VARCHAR(255) NULL,
    state VARCHAR(255) NULL,
    seeking VARCHAR(255) NULL,
    bio VARCHAR(255) NULL,
    premium tinyint NULL,
    interests VARCHAR(255) NULL,
    image VARCHAR(255) NULL,
    PRIMARY KEY (member_id)
    );

 CREATE TABLE member(
    interest_id INT NOT NULL AUTO_INCREMENT,
    interest VARCHAR(255) NULL,
    type VARCHAR(255) NULL,
    PRIMARY KEY (interest_id)
    );

CREATE TABLE member_interest(
    member_interest_id INT NOT NULL AUTO_INCREMENT,
    member_id INT NOT NULL,
    interest_id INT NOT NULL,
    PRIMARY KEY (member_interest_id),
    FOREIGN KEY (member_id) REFERENCES member (member_id),
    FOREIGN KEY (interest_id) REFERENCES interest (interest_id)
    );
 */

/**
 * Class Database
 */
class Database
{
    // PDO object
    private $_dbh;

    /*
     * Constructs a new Database PDO object
     */
    function __construct()
    {
        $this->_dbh = $this->connect();
    }

    /**
     * @return PDO|null the connection
     */
    function connect()
    {
        try {
            return new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        } catch(PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    /**
     * inserts the members to the database
     * @param $member the member object
     * @param $namePic the pic addy
     */
    function insertMember($member, $namePic)
    {
        $premium= -1;
        // define the query
        if($member->memberType() == 'member') {
            $premium = 0;
            $interests = null;
        }
        else {
            $premium = 1;
            $interests = $member->getOutdoorInterests() + $member->getIndoorInterests();
        }


        $sql = "INSERT INTO member VALUES(default, 
            :fname, :lname, :age, :gender, :phone, :email,:state, :seeking, :bio, $premium, :interests, :image)";

        // prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // bind the parameters
        $statement->bindParam(':fname', $member->getFName());
        $statement->bindParam(':lname', $member->getLName());
        $statement->bindParam(':age', $member->getAge());
        $statement->bindParam(':gender', $member->getGender());
        $statement->bindParam(':phone', $member->getPhone());
        $statement->bindParam(':email', $member->getEmail());
        $statement->bindParam(':state', $member->getState());
        $statement->bindParam(':seeking', $member->getSeeking());
        $statement->bindParam(':bio', $member->getBio());
        $statement->bindParam(':interests', $interests);
        $statement->bindParam(':image', $namePic);
        // execute statement
        $statement->execute();
        $memID = $this->_dbh->lastInsertId();

        $interestOption = array(
            "tv" => "1",
            "puzzles" => "2",
            "movies" => "3",
            "video games" => "4",
            "board games" => "5",
            "playing cards" => "6",
            "cooking" => "7",
            "reading" => "8",
            "collecting" => "9",
            "climbing" => "10",
            "swimming" => "11",
            "biking" => "12",
            "walking" => "13",
            "hiking" => "14",

        );

        for($i = 0; $i<sizeof($interests);$i++ ){
            $sql2 = "INSERT INTO member_interest VALUES(default, 
            :member_id, :interest_id, )";
            $val = $interests[$i];
            if (array_key_exists($val, $interestOption)) {
                $intVal = $interestOption[$val];
            }

            // prepare the statement
            $statement = $this->_dbh->prepare($sql2);

            $statement->bindParam(':member_id', $memID);
            $statement->bindParam(':interest_id', $intVal);
            $statement->execute();
        }

    }


    /**
     * get the members for the admin page
     * @return array of members signed up
     */
    function getMembers()
    {
        // define the query
        $sql = "SELECT * FROM member ORDER BY lname";
        // prepare statement
        $statement = $this->_dbh->prepare($sql);
        // execute statement
        $statement->execute();
        // get result
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * get the member for a profile page
     * @return member information
     */
    function getMember($member_id)
    {
        $sql = "SELECT * FROM member WHERE member_id = $member_id";
        // prepare statement
        $statement = $this->_dbh->prepare($sql);
        // bind parameters
        $statement->bindParam(':member_id', $member_id);
        // execute statement
        $statement->execute();
        return $statement->fetch();
    }
    /**
     * get the interests of a member
     * @return interest information
     */
    function getInterests($member_id)
    {
        $sql = "SELECT interests FROM member WHERE member_id = $member_id";
        // prepare  statement
        $statement = $this->_dbh->prepare($sql);
        // bind  parameters
        $statement->bindParam(':member_id', $member_id);
        // execute statement
        $statement->execute();
        return $statement->fetch();
    }
    /**
     * inserts the interests of a member into db
     */
    public function insertMemberInterests($member) {
        $id = $member->getID();
        $indoorInterests = $member->getIndoorInterests();
        $outdoorInterests = $member->getOutdoorInterests();
        if (!empty($indoorInterests)) {
            foreach ($indoorInterests AS $interest ) {
                $this->insertInterest($interest, $id);
            }
        }

        if (!empty($outdoorInterests)) {
            foreach ($outdoorInterests AS $interest ) {
                $this->insertInterest($interest, $id);
            }
        }
    }

    public function insertInterest($interest, $id) {

        $sql = "SELECT interestID FROM interest WHERE interest = :interest";

        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(":interest", $interest);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $interestID = $result['interestID'];

        $sql = "INSERT INTO memberInterest (memberID, interestID) VALUES (:id, :interestID)";

        $statement = $this->_dbh->prepare($sql);
        $statement->bindParam(":id", $id,PDO::PARAM_INT);
        $statement->bindParam(":interestID", $interestID,PDO::PARAM_INT);
        $statement->execute();
    }

}