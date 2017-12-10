<?php

class account extends model {
	//column names of accounts table
    public $id;
    public $username;
    public $email;
    public $fname;
    public $lname;
    public $phone;
    public $birthday;
    public $gender;
    public $password;

    //Logic to use multiple constructor in php
    public function __construct() {
        $this->tableName = 'accounts'; 
        $get_arguments       = func_get_args();
        $number_of_arguments = func_num_args();
        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }

    public function __construct8($username,$email,$fname,$lname,$phone,$birthday,$gender,$password) { 
        $this->username = $username;      
        $this->email = $email;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->phone = $phone;
        $this->birthday = $birthday;        
        $this->gender = $gender;
        $this->password = $password;
    }

    //returning header of accounts table
    public function getHeader() {
        return array('Id','User name','Email','First Name','Last Name','Phone','Birthday','Gender','Password');
    }

    //returning values stored in attributes (row of accounts table)
    public function getRecord() {
        return array($this->id,$this->username,$this->email,$this->fname,$this->lname,$this->phone,$this->birthday,$this->gender,$this->password);
    }
}

?>