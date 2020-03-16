<?php
class addDirectory{
    public function myFunction(){
        if (isset($_POST['submitDir'])) {

            $path = "directories/".$_POST['enterName'];

            if (file_exists($path)){
                return $output = 'A directory already exsists with that name.';
            }else{
                
                mkdir($path, 0777);
                $myfile = fopen($path."/readme.txt", "w") or die("Unable to open file.");
                fwrite($myfile, $_POST['fileContent']);
                fclose($myfile);
                //Creates a string for he HTML to create a link for.
                return $output = "<p>Path and file were created.</p><a href='".$path."/readme.txt'>{$path}/readme.txt</a>"; 
            }
            
            
        } else {
            return $output = "";
        }
    }
}
// $_POST['enterName'] -- this is the content variable we use for the directory name.
// $_POST['fileContent'] -- this is the content variable we put into the readme.
?>
