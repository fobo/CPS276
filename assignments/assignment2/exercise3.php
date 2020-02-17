<?php

$intRows = 15; //Change these to adjust your table!
$intColumns = 5;

$tableOutput = "<table border='1'>";
for($x = 1; $x < $intRows+1; $x++){
    $tableOutput .= "<tr>";
    for($y = 1; $y < $intColumns+1; $y++){ //the +1 prevents off by one errors
        $tableOutput .= "<td>Row {$x} Cell {$y}</td>"; 
    }
    $tableOutput .= "</tr>";
}
$tableOutput .= "</table>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercise 3</title>
</head>
<body>
    <?php
    echo $tableOutput;
    ?>
</body>
</html>