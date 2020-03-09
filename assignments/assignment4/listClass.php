<?php
class nameList{
    public function myFunction(){
        if (isset($_POST['addName'])) {
            $output = ""; //declaring variables
            $textArea;
            $textParts = explode(" ", $_POST['enterName']); //explodes input for manipulation
            $textArray = explode("\n", $_POST['namelist']); //explodes text area for manipulation            
            array_push($textArray, $textParts[1].", ".$textParts[0]); //adds correct input to array
            sort($textArray); //sorts array
            array_shift($textArray); // If I don't do this, adds a newline for some reason.  I would appreciate feedback on this issue.
            for ($i=0; $i < count($textArray); $i++) { 
                $output .= "$textArray[$i]\n"; //concatenates array into one string
            }
            return $output;
        }else{
            $output = "";
            return $output; // Don't even need to check which button was clicked if there are only two buttons.
        }
    }
}
?>

