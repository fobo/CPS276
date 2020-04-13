<?php

if(isset($_POST)){
  require_once 'addDisplayNote.php';
  $addNote = new AddDisplayNote();
  $output = $addNote->addNote($_POST);
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Add Note To DB</title>
</head>
<body>

<div class="container">
<form action="" method="post">
<h1>Add Note</h1>
<a href="displaynote.php">Display Notes</a>
  <p><?php echo $output;?></p>
  <div class="form-group">
    <label for="dateTime">Date and Time</label>
    <input type="datetime-local" class="form-control" id="dateTime" name="dateTime">
    <div class="form-group">
    <label for="noteText">Add your note here</label>
    <textarea type="text" class="form-control" rows="15" id="noteText" name="noteText"></textarea>
  </div>

  </div>
  <div class="form-group">
  </div>
  <button type="submit" class="btn btn-primary btn-lg" name="addNote" id="addNote">Add Note!</button>
</form>
</div>


</body>
</html>