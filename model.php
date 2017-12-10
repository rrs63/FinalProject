<?php

abstract class model {
    protected $tableName;
    public function save()
    {      
        $record = get_object_vars($this);
        array_pop($record);
        foreach ($record as $key => $value) {
            $value = "'$value'";
            $columnString[] = $key;
            $valueString[] = $value; 
            $updates[] = "$key = $value";
        }                
    
        if ($this->id == '') {           
            $sql = $this->insert(implode(',',$columnString),implode(',',$valueString));
        } else {            
            $sql = $this->update(implode(',',$updates));        
        }
        $db = dbConn::getConnection();
        $statement = $db->prepare($sql);
        $statement->execute();        

        //last_id is id of newly inserted record - can be used to update, delete same record
        $last_id = $db->lastInsertId();
        $map =  array(implode(',',$updates),$last_id);     
        return  $map; 
    }
    private function insert($columnString,$valueString) {        
        $sql =  "INSERT INTO " . $this->tableName." (" . $columnString . ") VALUES (" . $valueString . ")";      
        return $sql;
    }
    private function update($updates) {
        $sql = 'UPDATE ' . $this->tableName.' SET ' . $updates . ' WHERE id =' . $this->id;
        return $sql;        
    }
    public function delete() {
        $tableName = get_called_class();
        $sql = "DELETE FROM " . $this->tableName." WHERE id=" .$this->id; 
        $db = dbConn::getConnection();
        $statement = $db->prepare($sql);
        $statement->execute();         
    }
}

?>