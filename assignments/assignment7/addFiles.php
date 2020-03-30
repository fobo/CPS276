<?php
if(isset($_POST)){
  require_once 'fileUploadProc.php';
  $tryUpload = new uploadFile();
  $output = $tryUpload->funcUpload($_POST);
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>File Upload and Access</title>
</head>
<body>
<h1>File Upload</h1>
<a href="/assignment7/listFiles.php" target='_blank'>Show File List</a>
<form action="" method="post" enctype="multipart/form-data">
  <div class="form-group">
  <label for="userNameInput">File Name</label>
    <input type="text" class="form-control" name="userNameInput" id="userNameInput">
  </div>
  <div class="form-group">


  <input type="file" class="form-control-file" name="userFilePicker" id="userFilePicker">
  <button type="submit" class="btn btn-primary" name="userFileSubmit" id="userFileSubmit">Upload File</button>
  <div class="p-3 mb-2 bg-info text-white">
<?php echo $output;?>
</div>
</div>
</div>
</form>
</body>
</html>