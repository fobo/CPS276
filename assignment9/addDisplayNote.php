<?php
require 'classes/Pdo_methods.php';
class AddDisplayNote extends PdoMethods{


    public function addNote(){
        if(isset($_POST['addNote'])){

            //Open DB
            $pdo = new PdoMethods();

            
            //Build Query
            $sql = "INSERT INTO noteTable (note_data, note_time) VALUES (:note_data, :note_time)";

            $bindings = [
                [':note_data',$_POST['noteText'], 'str'],
                [':note_time',$_POST['dateTime'], 'str']
            ];

            //Send Query
            $result = $pdo->otherBinded($sql, $bindings);
            //Send All Clear to user
            if($result === 'error'){
                return 'There was an error adding to the database.';

            }else {
                return 'Added your note.';

            }
        }

    }

    public function fetchNote(){
        if(isset($_POST['fetchNote'])){

            //gather data from POST
            $begDate = $_POST['begDate'];
            $endDate = $_POST['endDate'];
            //Open DB
            $pdo = new PdoMethods();
            //Build Query
            $sql = "SELECT note_data, DATE_FORMAT(note_time, \"%c/%d/%Y %l:%i %p\") AS note_time FROM noteTable WHERE note_time >= :begDate AND note_time <= :endDate ORDER BY note_time;";

            $bindings = [
                [':begDate', $begDate, 'str'],
                [':endDate', $endDate, 'str']
            ];
            //Send Query
            $result = $pdo->selectBinded($sql,$bindings);
            //Organize results (if any)

            //Send all clear to user
            if($result === 'error'){
                return 'There was an error adding to the database.';

            }else {

                return $this->createTable($result);
            }
        }
    }

    public function createTable($records){
        $list = "";
        foreach($records as $row){
            $list .= "<tr>"; // Start
            $list .= "<td scope='row'>{$row['note_time']}</td>"; // item 1
            $list .= "<td>{$row['note_data']}</td>"; // item 2
            $list .= "</tr>"; // end
        }
        return $list;
    }
}



?>
