<?php 
//write the code for displaying the names when the "Display Names" button is clicked here.
require '../classes/Pdo_methods.php';

$pdo = new PdoMethods();
$sql = "SELECT * FROM names ORDER BY nameLast";
        $records = $pdo->selectNotBinded($sql);
        $namesReturn = (object)[
            'masterstatus'=>'success',
            'msg'=>'this message',
            'names'=>''
        ];
        foreach ($records as $row){
            $fname = "{$row['nameFirst']}";
            $lname = "{$row['nameLast']}";
            $stringBuilder = $lname.", ".$fname;
            $namesReturn->names .= $stringBuilder."\n";
        }

        echo json_encode($namesReturn);
?>