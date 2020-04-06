<?php
require '../classes/Pdo_methods.php';



    $data = json_decode($_POST['data']);

    $output = "{$data->name}";

    $string_explode = explode(" ", $output);
    $firstName = $string_explode[0];
    $lastName = $string_explode[1];

    $pdo = new PdoMethods();
    $sql = "INSERT INTO names (nameFirst, nameLast) VALUES (:nameFirst, :nameLast)";

    $bindings = [
        [':nameFirst', $firstName,'str'],
        [':nameLast', $lastName,'str']
    ];
    $result = $pdo->otherBinded($sql, $bindings);

    if($result === 'error'){
        return 'error adding stuff';
    }else{
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
    }
    
        
    
    echo json_encode($namesReturn);

    




?>