<?php

abstract class collection {  

    static public function findAll() {
        $db = dbConn::getConnection();
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName;
        $statement = $db->prepare($sql);
        $statement->execute();
        $class = static::$modelName;
        $statement->setFetchMode(PDO::FETCH_CLASS, $class);
        $recordsSet =  $statement->fetchAll();
        return $recordsSet;
    }

    static public function findAllForUser($id) {
        $db = dbConn::getConnection();
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE ownerid =' . $id;
        $statement = $db->prepare($sql);
        $statement->execute();
        $class = static::$modelName;
        $statement->setFetchMode(PDO::FETCH_CLASS, $class);
        $recordsSet =  $statement->fetchAll();
        return $recordsSet;
    }

    static public function findOne($id) {
        $db = dbConn::getConnection();
        $tableName = get_called_class();
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE id =' . $id;
        $statement = $db->prepare($sql);
        $statement->execute();
        $class = static::$modelName;
        $statement->setFetchMode(PDO::FETCH_CLASS, $class);
        $recordsSet =  $statement->fetchAll();
        return $recordsSet[0];
    }

    static public function find($username,$password) {
        $db = dbConn::getConnection();
        $tableName = get_called_class();    
        $sql = 'SELECT * FROM ' . $tableName . ' WHERE username = "'.$username.'"';//' AND password ="'.$password.'"';//username =' . $username . ' AND password =' .$password;
        $statement = $db->prepare($sql);
        $statement->execute();
        $class = static::$modelName;
        $statement->setFetchMode(PDO::FETCH_CLASS, $class);
        $recordsSet =  $statement->fetchAll();        
        if(count($recordsSet)==0)
            return null;
        $row = $recordsSet[0]->getRecord();
        $passHash = $row[8];
        if(!password_verify($password,$passHash)) {
            return null;
        }
        return $recordsSet[0];
    }
}


?>