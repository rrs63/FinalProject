<?php 

class page {
    protected $html;
    private $username;
    private $password;
    public function __construct() {

        $this->html .= '<html>';
        $this->html .= '<link rel="stylesheet" href="styles.css">';
        $this->html .= "<head><script>
            function validateUser()
            {
                var username=document.forms['signup']['username'].value;
                var firstname=document.forms['signup']['firstname'].value;
                var lastname=document.forms['signup']['lastname'].value;
                var password=document.forms['signup']['password'].value;
                var email=document.forms['signup']['email'].value;
                var errors = '';
                if (username==null || username=='')
                {
                    errors += 'User name must be filled out.';                                        
                }            
                else if(!(/^[a-zA-Z0-9]+$/.test(username))) {
                    errors += 'User name can contain only alphabets and numbers.';                    
                }
                if (email==null || email=='')
                {
                    errors += 'Email must be filled out.';                                        
                } 
                if(firstname.length<1) {
                    errors += 'First name must contain at least 1 character.';                    
                }
                if(lastname.length<1) {
                    errors += 'Last name must contain at least 1 character.';                 
                }
                if(password.length<6) {
                    errors += 'Password must contain at least 6 characters.';                 
                }
                if(errors !='') {
                    alert(errors);
                    return false;
                }
            }  
            function validateUpdatedUser()
            {                
                var firstname=document.forms['updateprofile']['firstname'].value;
                var lastname=document.forms['updateprofile']['lastname'].value;
                var password=document.forms['updateprofile']['password'].value;
                var email=document.forms['updateprofile']['email'].value;
                var errors = '';  
                if (email==null || email=='')
                {
                    errors += 'Email must be filled out.';                                        
                }              
                if(firstname.length<1) {
                    errors += 'First name must contain at least 1 character.';                    
                }
                if(lastname.length<1) {
                    errors += 'Last name must contain at least 1 character.';                 
                }                
                if(password.length<6) {
                    errors += 'Password must contain at least 6 characters.';                 
                }
                if(errors !='') {
                    alert(errors);
                    return false;
                }
            }  
            function validateTodo()
            {
                var message=document.forms['changetodo']['message'].value;                                            
                if(message.length<=1) {
                    alert('Todo message must be more than 1 character');
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
        $this->html .="Not an account ? <a href = 'https://web.njit.edu/~rrs63/FinalProject/index.php?page=signup'> Sign up </a>";
    }

    public function signup() {
    	$this->html .="<h2> Sign up</h2>        
        <form name='signup' method='post' action='https://web.njit.edu/~rrs63/FinalProject/index.php?page=createAccount' onsubmit='return validateUser()'>   
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
        $this->html .="Back to <a href = 'https://web.njit.edu/~rrs63/FinalProject/index.php?page=login'> login </a>";
    }

    public function updateProfile($user) {
        $this->html .="<h2> Update user profile</h2>        
        <form name='updateprofile' method='post' action='https://web.njit.edu/~rrs63/FinalProject/index.php?page=updateProfile' onsubmit='return validateUpdatedUser()'>      
        First name: <input type='text' name='firstname' value='". $user[3] ."'>
        <br/><br/>
        Last name: <input type='text' name='lastname' value='". $user[4] ."'>
        <br/><br/>  
        E-mail: <input type='email' name='email' value='". $user[2] ."'>
        <br/><br/>
        Password: <input type='password' name='password' value='". $user[8] ."'>
        <br/><br/>       
        <input type='submit' name='submit' value='Submit'>          
        </form>";
        $this->html .="<a href = 'https://web.njit.edu/~rrs63/FinalProject/index.php?page=displayHomepage&message='> Cancel </a>";
    }

    public function edittodo($record) {      
        $this->html .="<h2>Edit todo item</h2>        
        <form name='changetodo' method='post' action='https://web.njit.edu/~rrs63/FinalProject/index.php?page=editTodo' onsubmit='return validateTodo()'>   
        Id: <input type='number' name='id' readonly value='". $record[0] ."'>
        <br/><br/>     
        Owner email: <input type='email' name='owneremail' value='". $record[1] ."'>
        <br/><br/>
        Owner id: <input type='number' name='ownerid' readonly value='". $record[2] ."'>
        <br/><br/>  
        Created date <input type='datetime' name='createddate' value='". $record[3] ."' disabled>
        <br/><br/>
        Due date <input type='datetime' name='duedate' value='". $record[4] ."' disabled>
        <br/><br/>  
        Message: <input type='text' name='message' value='". $record[5] ."'>
        <br/><br/>
        isDone: <input type='number' min='0' max='1' name='isdone' value='". $record[6] ."'>
        <br/><br/>       
        <input type='submit' name='submit' value='Submit'>  
        </form>";
        $this->html .="<a href = 'https://web.njit.edu/~rrs63/FinalProject/index.php?page=displayHomepage&message='> Cancel </a>";
    }

    public function addtodo() {  
        $this->html .="<h2>Add todo item</h2>        
        <form name='changetodo' method='post' action='https://web.njit.edu/~rrs63/FinalProject/index.php?page=addTodo' onsubmit='return validateTodo()'>          
        Owner email: <input type='email' name='owneremail'>
        <br/><br/>       
        Created date <input type='datetime-local' name='createddate'>
        <br/><br/>
        Due date <input type='datetime-local' name='duedate'>
        <br/><br/>  
        Message: <input type='text' name='message'>
        <br/><br/>
        isDone: <input type='number' min='0' max='1' name='isdone'>
        <br/><br/>       
        <input type='submit' name='submit' value='Submit'>  
        </form>";
        $this->html .="<a href = 'https://web.njit.edu/~rrs63/FinalProject/index.php?page=displayHomepage&message='> Cancel </a>";
    }     
    public function __destruct() {
        $this->html .= '</body></html>';
        //stringFunctions::printThis($this->html);
        echo $this->html;
    }    
}

?>
