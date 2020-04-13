<?php

if(isset($_POST)){
  require_once 'addDisplayNote.php';
  $displayNote = new AddDisplayNote();
  $output = $displayNote->fetchNote($_POST);
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Display Note Page with Table</title>
</head>
<body>

<div class="container">
<form action="" method="post">
<h1>Display Notes</h1>
<a href="addnote.php">Add Notes</a>
  
  <div class="form-group">
    <p>Beginning Date</p>
    <input type="date" class="form-control" id="begDate" name="begDate">
    <p>Ending Date</p>
    <input type="date" class="form-control" id="endDate" name="endDate">
    </div>
    <div class="form-group">
  <button type="submit" class="btn btn-primary btn-lg" name="fetchNote" id="fetchNote">Get Notes</button>
  </div>
    </br>
    <div class="form-group">
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Date and Time</th>
      <th scope="col">Note</th>
    </tr>
  </thead>
    <?php echo $output;?>
  <tbody>
<?php $output ?>
  </tbody>
</table>

    </div>
</form>
</div>
</body>
</html>