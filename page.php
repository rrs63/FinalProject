<?php 

class page {
    protected $html;
    private $username;
    private $password;
    public function __construct() {

        $this->html .= '<html>';
        $this->html .= '<link rel="stylesheet" href="styles.css">';
        $this->html .= "<head><script>
            function validateForm()
            {
                var username=document.forms['signup']['username'].value;
                if (username==null || username=='')
                {
                    alert('User name must be filled out');
                    return false;
                }            
                else if(!(/^[a-zA-Z0-9]+$/.test(username))) {
                    alert('User name can contain only alphabets and numbers');
                    return false;
                }
            }            
        </script></head>";              
        $this->html .= '<body>';               
    }

    public function login() {
    	 $this->html .="<h2> Log in</h2>
         <form method='post' action='https://web.njit.edu/~rrs63/FinalProject/index.php?page=login'>        
        User name: <input type='text' name='username'>
        <br/><br/>       
        Password: <input type='password' name='password'>
        <br/><br/>       
        <input type='submit' name='submit' value='Submit'>  
        </form>";
    }

    public function signup() {
    	$this->html .="<h2> Sign up</h2>        
        <form name='signup' method='post' action='https://web.njit.edu/~rrs63/FinalProject/index.php?page=createAccount' onsubmit='return validateForm()'>   
        User name: <input type='text' name='username'>
        <br/><br/>     
        E-mail: <input type='email' name='email'>
        <br/><br/>
        First name: <input type='text' name='firstname'>
        <br/><br/>
        Last name: <input type='text' name='lastname'>
        <br/><br/>  
        Password: <input type='password' name='password'>
        <br/><br/>       
        <input type='submit' name='submit' value='Submit'>  
        </form>";

    }

    public function edittodo($record) {        
        $this->html .="<h2>Edit todo item</h2>        
        <form name='edittodo' method='post' action='https://web.njit.edu/~rrs63/FinalProject/index.php?page=editTodo'>   
        Id: <input type='number' name='id' readonly value='". $record[0] ."'>
        <br/><br/>     
        Owner email: <input type='email' name='owneremail' value='". $record[1] ."'>
        <br/><br/>
        Owner id: <input type='number' name='ownerid' readonly value='". $record[2] ."'>
        <br/><br/>  
        Created date <input type='datetime-local' name='createddate' value='". $record[3] ."'>
        <br/><br/>
        Due date <input type='datetime-local' name='duedate' value='". $record[4] ."'>
        <br/><br/>  
        Message: <input type='text' name='message' value='". $record[5] ."'>
        <br/><br/>
        isDone: <input type='number' min='0' max='1' name='isdone' value='". $record[6] ."'>
        <br/><br/>       
        <input type='submit' name='submit' value='Submit'>  
        </form>";

    }
    public function __destruct() {
        $this->html .= '</body></html>';
        //stringFunctions::printThis($this->html);
        echo $this->html;
    }    
}

?>
