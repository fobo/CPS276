<?php

$parentList = 4; //Change these to adjust your list!
$childList = 5;

$listOutput = "<ul>";
for($x = 1; $x < $parentList+1; $x++){
    $listOutput .="<li>{$x}</li><ul>";
    for($y = 1; $y < $childList+1; $y++){ //the +1 prevents off by one errors
        $listOutput .= "<li>{$y}</li>"; 
    }
    $listOutput .="</ul>";
}
$listOutput .= "</ul>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 1</title>
</head>
<body>
    <?php
    echo $listOutput;
    ?>
</body>
</html>