<?php

require_once ("config-member.php");

class Database
{
    // PDO object
    private $_dbh;

    function __construct()
    {
        try{
            // create new pdo connection
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME,DB_PASSWORD);
       //     echo "Connected";
        }

        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    function getMember()
    {
        // 1. Define query
        $sql = "";

        // 2. Prepare the statement
        $statement = $this->_dbh->prepare($sql);

        // 3. Bind the parameter

        // 4. Execute the statement
        $statement->execute();

        // 5. Get the result
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}