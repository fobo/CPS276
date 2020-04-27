<?php
//$result = ["",""]; // create an empty array so the echo doesnt do anything dumb on init load
/*
WRITE THE NECESSARY PHP CODE HERE NOT THE $RESULT ARRAY ON LINES 35 AND 36.
YOU WILL NEED TO RETURN AN ARRAY THAT CONTIANS TO INDEXES.
FIRST IS A PLACE FOR A MESSAGE (MAYBE BLANK OR NOT DEPENDING ON THE SITUATION)
AND THE OTHER IS THE FORM OR THE TABLE DISPLAYING THE DATA
*/
if(isset($_GET['page'])){
	if($_GET['page'] === "form"){
		require_once('php/form.php');
		$result = init();
	}
	elseif ($_GET['page'] === "display") {
		require_once('php/displayRecords.php');
		$result[0] = "";
		$result[1] = getData();
	}
}
else{
	require_once('php/form.php');
	$result = init();
}

/*THE FORM.PHP PAGE HAS AN INIT FUNCTION THAT STARTS EVERYTING SO I CALL THAT.  THE RESULT VARIABLE CONTAINS WHATEVER WAS RETURNED FROM THE FORM PAGE.*/
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Final Project</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<style>
			.error {
				color: red;
				margin-left: 5px;
			}
			.space {
				margin-right: 30px;
			}
			nav ul li {
				list-style: none;
			}
			</style>
	</head>

	<body class="container">
		<nav>
			<ul>
				<li><a href="index.php?page=form">Add Contact Information</a></li>
				<li><a href="index.php?page=display">Display All Contacts Information</a></li>
			</ul>
		</nav>


		
		<?php
			echo $result[0]; 
			echo $result[1]; 
		?>
	</body>
</html> 