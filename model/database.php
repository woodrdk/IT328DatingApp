<?php

require_once ("config-member.php");

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

        return $this->_dbh->lastInsertId();
    }


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

        $sql2 = "INSERT INTO memberInterest (memberID, interestID) VALUES (:id, :interestID)";

        $statement = $this->_dbh->prepare($sql2);
        $statement->bindParam(":id", $id,PDO::PARAM_INT);
        $statement->bindParam(":interestID", $interestID,PDO::PARAM_INT);
        $statement->execute();

    }

}