<?php

if(isset($_POST)){
  require_once 'addDir.php';
  $submitDir = new addDirectory();
  $output = $submitDir->myFunction($_POST);
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Exercise 5</title>
</head>
<body>
<div class="container">
<form action="" method="post">
<h1>File and Directory Assignment</h1>
  <div class="form-group">
    <label for="enterName">Folder Name</label>
    <input type="name" class="form-control" id="enterName" name="enterName">
  </div>
  <div class="form-group">
  <p><?php echo $output;?></p>
    <label for="fileContent">File Content</label>
    <textarea type="text" class="form-control" rows="15" id="fileContent" name="fileContent"></textarea>
  </div>
  <button type="submit" class="btn btn-primary btn-lg" name="submitDir" id="submitDir">Submit</button>
</form>
</div>
<?php

?>
</body>
</html>