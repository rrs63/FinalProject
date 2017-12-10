<?php

class htmlTable {
    static private $html = '';   

    //This function can be called to display table 
    static public function displayTable($records) {      
        if(is_array($records)) {           
            if(count($records) > 0) {               
                self::$html = '<table style="border: 1px solid black;border-collapse: collapse;">'; 
                self::displayHeader($records[0]->getHeader());
                for($x = 0; $x < count($records); $x++) {                                       
                    self::displayRecord($records[$x]->getRecord());                                            
                }                
                self::$html .= '</table>';  
            }
            else {
                self::$html = "<b>0 Results</b>";
            } 
        }
        else {            
            self::$html = '<table style="border: 1px solid black;border-collapse: collapse;">'; 
            self::displayHeader($records->getHeader());            
            self::displayRecord($records->getRecord());  
            self::$html .= '</table>';                                                  
        }            
        echo self::$html;
    }

    //displaying header in table
    static public function displayHeader($header) {
        self::$html .= '<tr style="border: 1px solid black;border-collapse: collapse;">';
        for($x = 0; $x < count($header); $x++) { 
            self::$html .= '<th style="border: 1px solid black;border-collapse: collapse;">'.$header[$x].'</th>';
        }
        self::$html .= '</tr>';  

    }

    //displaying row in table
    static public function displayRecord($record) {
        self::$html .= '<tr style="border: 1px solid black;border-collapse: collapse;">';
        for($x = 0; $x < count($record); $x++) { 
            self::$html .= '<td style="border: 1px solid black;border-collapse: collapse;">'.$record[$x].'</td>';
        }
        self::$html .= '</tr>'; 
    }


    //displays title for table 
    static public function displayTitle($header) {    
        self::$html = '<h1>'.$header.'</h1>';
        echo self::$html;
    }  

    //displays message for table
    static public function displayMessage($message) {
        self::$html = '<p>'.$message.'</p>';
        echo self::$html;
    }  

    //breaks line
    static public function breakLine($no) {
        self::$html = '';
        for($x=0;$x<$no;$x++) {
            self::$html .= '<br/>';
        }
        echo self::$html;
    }
}

?>