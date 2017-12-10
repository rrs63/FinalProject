<?php 

class page {
    protected $html;

    public function __construct() {
        $this->html .= '<html>';
        $this->html .= '<link rel="stylesheet" href="styles.css">';              
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
        <form method='post' action='https://web.njit.edu/~rrs63/FinalProject/index.php?page=createAccount'>   
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
