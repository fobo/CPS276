<?php

require 'classes/Pdo_methods.php';

/*THIS IS THE GET FROM FUCTION WHICH WILL BUILD THE FORM BASED UPON UPON THE (UNMODIFIED OF MODIFIED) ELEMENTS ARRAY. */
function getData(){
    $pdo = new PdoMethods();
    $sql = "SELECT * FROM contacts";
    $result = $pdo->selectNotBinded($sql);
    $list = "";
    foreach($result as $row){
        $list .= "<tr>";
        $list .= "<td scope ='row'>{$row['name']}</td>";
        $list .= "<td>{$row['address']}</td>";
        $list .= "<td>{$row['phone']}</td>";
        $list .= "<td>{$row['email']}</td>";
        $list .= "<td>{$row['dob']}</td>";
        $list .= "<td>{$row['contypes']}</td>";
        $list .= "<td>{$row['agerange']}</td>";
        $list .= "</tr>";
    }


    /*
    foreach($records as $row){
        $list .= "<tr>"; // Start
        $list .= "<td scope='row'>{$row['note_time']}</td>"; // item 1
        $list .= "<td>{$row['note_data']}</td>"; // item 2
        $list .= "</tr>"; // end
    }
    */

$form = <<<HTML
    <div class="form-group">
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Address</th>
      <th scope="col">Phone</th>
      <th scope="col">Email</th>
      <th scope="col">DOB</th>
      <th scope="col">Contact</th>
      <th scope="col">Age</th>
    </tr>
  </thead>

  <tbody>
  {$list}
  </tbody>
</table>

    </div>
HTML;


/* HERE I RETURN AN ARRAY THAT CONTAINS AN ACKNOWLEDGEMENT AND THE FORM.  THIS IS DISPLAYED ON THE INDEX PAGE. */
return $form;

}

//NAME ADDRESS PHONE EMAIL DOB CONTACT AGE
?>