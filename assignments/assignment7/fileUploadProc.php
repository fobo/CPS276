<?php
require 'Pdo_methods.php';

class uploadFile extends PdoMethods{

    public function funcUpload(){
        if (isset($_POST['userFileSubmit'])){
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["userFilePicker"]["name"]);
            $uploadOk = 1;


            //size checker
            if ($_FILES["userFilePicker"]["size"] > 100000) {
                $uploadOk = 0;
                return $output = "File too large.";
                
            }
            //type checker
            if($_FILES['userFilePicker']["type"] != 'application/pdf'){
                $uploadOk = 0;
                return "Wrong file type!";
            }
            if(empty($_POST['userNameInput'])){
                $uploadOk = 0;
                return "You must enter something to call your file!";
            }

            if ($uploadOk == 0) {
                return $output = "File failed to upload.";
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["userFilePicker"]["tmp_name"], $target_file)) {
                    $pdo = new PdoMethods();

                    $sql = "INSERT INTO files (fname, flocation) VALUES (:fname, :flocation)";
            
                    $bindings = [
                        [':fname',$_POST['userNameInput'],'str'],
                        [':flocation',$_FILES['userFilePicker']['name'],'str']
                    ];
            
                    $result = $pdo->otherBinded($sql, $bindings);
            
                    if($result === 'error'){
                        return 'There was an error adding the file.';
            
                    } else{
                        return $output = "The file ". basename( $_FILES["userFilePicker"]["name"]). " has been uploaded.";
                    }
                    
                //SQL Goes here, since the file was uploaded properly
                
                } else {
                    return $output = "Sorry, there was an error uploading your file.";
                }
            }
            
            /*
            Get data from page (User name of file, and file)
            Check if file meets requirements(Size, MIME type)
            Put file LOCATION into database
            */
        }
    }

    public function displayFiles(){

        $pdo = new PdoMethods();

        $sql = "SELECT * FROM files";
        $records = $pdo->selectNotBinded($sql);

        if($records == 'error'){
            return "There has been an error getting the data.";
        }else{
            if(count($records) != 0){
                return $this->createList($records);
            }else{
                return "No items found.";
            }
        }


    
    }

    public function createList($records){
            $list ='<ol>';
            foreach ($records as $row) {
                $list .= "<li><a href=\"uploads/{$row['flocation']}\" target='_blank'>{$row['fname']}</a></li>";
            }
            $list .= '</ol>';
        return $list;
    }

}
?>

