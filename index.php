<?php

//turn on debugging messages
ini_set('display_errors', 'On');
error_reporting(E_ALL);


define('DATABASE', 'rrs63');
define('USERNAME', 'rrs63');
define('PASSWORD', '6hGttGyh');
define('HOSTNAME', 'sql1.njit.edu');


//Autoload other classes
class Manage {
public static function autoload($class) {
    //you can put any file name or directory here
    include $class . '.php';
}
}

spl_autoload_register(array('Manage', 'autoload'));


//class contains methods to fetch data from todos table
class todos extends collection {
protected static $modelName = 'todo';
}

//class contains methods to fetch data from accounts table
class accounts extends collection {
protected static $modelName = 'account';
}


$pageRequest = 'login';
    
    //check if there are parameters
	if(isset($_REQUEST['page'])) {
	    //load the type of page the request wants into page request
	    $pageRequest = $_REQUEST['page'];
	}        
    
    //instantiate the class that is being requested    	

    //Proper method is called based on get or post method
    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        if($pageRequest=='login') {
        	$page = new page;
            $page->login();
        }
        else if($pageRequest == 'signup') {
        	$page = new page;
        	$page->signup();
        }  
        else if($pageRequest == 'logout') {        	
        	session_destroy(); 
        	header('Location: index.php?page=login'); 
        }                  
        else if($pageRequest == 'editTodo') {           
            $record = todos::findOne($_REQUEST['id']);
            $page = new page;
            $page->edittodo($record->getRecord());
        }
        else if($pageRequest == 'deleteTodo') {          
            $record = todos::findOne($_REQUEST['id']);
            $record->delete();            
            htmlTable::displayMessage("Record deleted");
            header('Location: index.php?page=displayHomepage&message=Record deleted');
        }
        else if($pageRequest == 'addTodo') {
            $page = new page;
            $page->addtodo();
        } 
        else if($pageRequest == 'updateUserProfile') {
            $page = new page;
            session_start();  
            $user = accounts::findOne($_SESSION["userid"]);
            $page->updateProfile($user->getRecord());
        }        
        else if($pageRequest == 'displayHomepage') {
            session_start();
            htmlTable::displayTitle("Your todo items");          
            htmlTable::displayMessage($_REQUEST['message']);                
            $records = todos::findAllForUser($_SESSION["userid"]);               
            htmlTable::displayTable($records);          
            htmlTable::displayMessage("<a href='https://web.njit.edu/~rrs63/FinalProject/index.php?page=updateUserProfile'>Update user profile</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='https://web.njit.edu/~rrs63/FinalProject/index.php?page=addTodo'>Add todo record</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href='https://web.njit.edu/~rrs63/FinalProject/index.php?page=logout'>Log out </a>");  
        }
    } else {       
    	if($pageRequest=='createAccount') {            
		    $record = new account($_POST["username"],$_POST["email"],$_POST["firstname"],$_POST["lastname"],"","","",password_hash($_POST["password"], PASSWORD_BCRYPT));
			$savedRecord = $record->save();
			htmlTable::displayMessage("Account created successfully<br/>Go back to&nbsp;<a href='https://web.njit.edu/~rrs63/FinalProject/index.php?page=login'>login</a>");		 
        }         
        else if($pageRequest=='login') {
        	$record = accounts::find($_POST["username"],$_POST["password"]);
        	//$record = accounts::find("pateldhiren494","abcd");            
        	if($record==null)
        		htmlTable::displayMessage("Username or Password incorrect. please try again.<br/>Back to <a href = 'https://web.njit.edu/~rrs63/FinalProject/index.php?page=login'> login </a>");
        	else {	                          	
        		session_start();   
                $_SESSION["userid"] = $record->id;
                $_SESSION["username"] = $_POST["username"];
                header('Location: index.php?page=displayHomepage&message=');             
        	}
        }
        else if($pageRequest=='editTodo') {                        
            $record = todos::findOne($_POST["id"]);
            $record->owneremail = $_POST["owneremail"];
            $record->ownerid = $_POST["ownerid"];
            $record->message = $_POST["message"];
            $record->isdone = $_POST["isdone"];
            $updatedRecord = $record->save();
            header('Location: index.php?page=displayHomepage&message=Record updated');
        }
        else if($pageRequest=='addTodo') { 
            session_start(); 
            $record = new todo($_POST["owneremail"],$_SESSION["userid"],$_POST["createddate"],$_POST["duedate"],$_POST["message"],$_POST["isdone"]);
            $savedRecord = $record->save();                 
            header('Location: index.php?page=displayHomepage&message=Record added');

        }
        else if($pageRequest=='updateProfile') { 
            session_start();      
            $record = accounts::findOne($_SESSION["userid"]); 
            $record->email = $_POST["email"];
            $record->fname = $_POST["firstname"];
            $record->lname = $_POST["lastname"];
            if(strlen($_POST["password"])<50)
                $record->password = password_hash($_POST["password"], PASSWORD_BCRYPT);       
            $record->save();     
            header('Location: index.php?page=displayHomepage&message=Your profile updated');
        }
    }
?>


