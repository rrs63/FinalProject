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
        <form name='signup' method='post' action='https://web.njit.edu/~rrs63/FinalProject/index.php?page=createAccount' onsubmit='return validateForm()''>   
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
    public function __destruct() {
        $this->html .= '</body></html>';
        //stringFunctions::printThis($this->html);
        echo $this->html;
    }    
}

?>
