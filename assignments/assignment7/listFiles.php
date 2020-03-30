<?php
  require_once 'fileUploadProc.php';
  $display = new uploadFile();
  $output = $display->displayFiles($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>List Files</title>
</head>
<body>
    <h1>List Files</h1>
    <a href="/assignment7/addFiles.php">Add File</a>
<br>
<?php
echo $output;
?>
</body>
</html>