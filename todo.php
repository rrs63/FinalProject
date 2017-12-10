<?php

class todo extends model {
	//column names of todos table
    public $id;
    public $owneremail;
    public $ownerid;
    public $createddate;
    public $duedate;
    public $message;
    public $isdone;

    //Logic to use multiple constructor in php
    public function __construct() {
        $this->tableName = 'todos';
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();
        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }

    public function __construct6($owneremail,$ownerid,$createddate,$duedate,$message,$isdone) {        
        $this->owneremail = $owneremail;
        $this->ownerid = $ownerid;
        $this->createddate = $createddate;
        $this->duedate = $duedate;
        $this->message = $message;
        $this->isdone = $isdone;
    }
    

    //returning header of todos table
    public function getHeader() {
        return array('Id','Owner Email','Owner Id','Created Date','Due Date','Message','IsDone');
    }

    //returning values stored in attributes (row of todos table)
    public function getRecord() {
        return array($this->id,$this->owneremail,$this->ownerid,$this->createddate,$this->duedate,$this->message,$this->isdone);
    }
}

?>