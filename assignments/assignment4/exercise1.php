<?php

if(isset($_POST)){
  require_once 'listClass.php';
  $addName = new nameList();
  $output = $addName->myFunction($_POST);
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Exercise 4</title>
</head>
<body>
<div class="container">
<form action="" method="post">
<h1>Add Names</h1>
    <button type="submit" class="btn btn-primary btn-lg" name="addName" id="addName">Add Name</button>
    <button type="submit" class="btn btn-primary btn-lg">Clear Names</button>
  <div class="form-group">
    <label for="enterName">Enter Name</label>
    <input type="name" class="form-control" id="enterName" name="enterName">
  </div>
  <div class="form-group">
    <label for="nameList">List of Names</label>
    <textarea type="text" class="form-control" rows="15" id="namelist" name="namelist"><?php echo $output?></textarea>
  </div>
</form>
</div>
<?php

?>
</body>
</html>