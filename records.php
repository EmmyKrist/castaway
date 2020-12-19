<?

/*

As demonstrated in Unit 3, Lesson 14...

This file contains a form that can add and edit records in your options database tables. 
The HTML form submits back to itself for processing.

It assumes your 3 tables are named:
- ingredients
- equipment
- directions

These spellings have to be identical, including how the letters are lowercase.

If your 3 database tables are spelled differently, then change the values of 
$table1, $table2, and $table3.

*/


// require the database configuration you set up in database.php
require 'database.php';


// what are the 3 table names?
$table1 = "Option 1";
$table2 = "Option 2";


// prep default values of form display
$displayDBaction = "add";
$displayID = "";
$displayTable = "";
$displayNumber = "";
$displayName = "";
$displayText = "";


// read submitted data, if any, from the $_REQUEST array, which contains GET and POST
$DBactionToTake = $_REQUEST["dba"];
$choicesID = mysqli_real_escape_string($db, $_REQUEST["rID"]);
$choicesTable = mysqli_real_escape_string($db, $_REQUEST["rTable"]);
$choicesNumber = mysqli_real_escape_string($db, $_REQUEST["rNumber"]);
$choicesName = mysqli_real_escape_string($db, $_REQUEST["rName"]);
$choicesText = mysqli_real_escape_string($db, $_REQUEST["rText"]);



// The form accepts 3 possible actions to take:
// - edit: displaying an existing record (by ID) to edit
// - add: adding a new record of submitted data
// - save: saving an edited record
// 
// This action to take is passed in the hidden "DBaction" form input field.

if ($DBactionToTake == "edit") {
	
	// fetch and display record of that ID for editing
	$sql = "SELECT * FROM $choicesTable
					WHERE id=$choicesID";
	$result = $db->query($sql);
	if (!$result) die("Select Error: " . $sql . "<br>" . $db->error);
	
	// if there is a result, let's display it; we assume it's only 1 row
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$displayTable = $choicesTable;
		$displayName = $row["name"];
		$displayNumber= $row["sequence"];
		$displayText = $row["content"];
		$displayID = $recipeID;
		$displayDBaction = "save";
	}
	
	
	
} else if ($DBactionToTake == "add") {
	
	// make sure there's actually text submitted
	if ($choicesText != "") {
	
		// make sure the same data isn't being submitted twice
		$sql = "SELECT * FROM $choicesTable
						WHERE name='$choicesName' AND sequence='$choicesNumber' AND content='$choicesText'";
		$result = $db->query($sql);
		if (!$result) die("Add/Select Error: " . $sql . "<br>" . $db->error);

		if ($result->num_rows == 0) {
			// add new submitted record to DB, then display blank form
			$sql = "INSERT INTO $choicesTable (name, sequence, content)
							VALUES ( '$choicesName', '$choicesNumber', '$choicesText')";
			if ($db->query($sql) !== TRUE) die("Insert Error: " . $sql . "<br>" . $db->error);
		}

	}
	
	$displayTable = $choicesTable;
	$displayName = $choicesName;

	
} else if ($DBactionToTake == "save") {
	
	// update record in DB, then display blank form
	$sql = "UPDATE $choicesTable 
					SET name='$choicesName', sequence='$choicesNumber', content='$choicesText' 
					WHERE id=$choicesID";
	if ($db->query($sql) !== TRUE) die("Update Error: " . $sql . "<br>" . $db->error);
	
	$displayTable = $choicesTable;
	$displayName = $choicesName;
	
} else {
	
	// do nothing, blank form

}


?><!DOCTYPE html>
<html>
<head>
	
	<!-- meta tags and title -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Options DB Management</title>
	<script>
	</script>
	<style>
		tr:nth-child(odd) {
			background-color: #ddd;
		}
		td {
			padding: 7px;
		}
		textarea {
			width: 300px;
			height: 150px;
		}
	</style>

</head>
<body>

<form method="post">
	<p>
		Recipe: <input type="text" name="rName" id="rName" value="<?= $displayName; ?>">
	</p>
	<p>
		Table: 
		<select name="rTable" id="rTable">
			<option value="<?= $table1; ?>" <? if ($displayTable == $table1) echo "selected"; ?>><?= $table1; ?></option>
			<option value="<?= $table2; ?>" <? if ($displayTable == $table2) echo "selected"; ?>><?= $table2; ?></option>
			<option value="<?= $table3; ?>" <? if ($displayTable == $table3) echo "selected"; ?>><?= $table3; ?></option>
		</select>
	</p>
	<p>
		Step #: <input type="number" name="rNumber" id="rNumber" value="<?= $displayNumber; ?>">
	</p>
	<p>
		Text: <textarea name="rText" id="rText"><?= $displayText; ?></textarea>
	</p>
	<p>
		<input type="hidden" name="dba" id="dba" value="<?= $displayDBaction; ?>">
		<input type="hidden" name="rID" id="rID" value="<?= $displayID; ?>">
		<button type="submit">Save</button>
		<button onclick="window.location.replace('records.php')">Cancel</button>
	</p>
</form>
<hr>
	
<?

// function to output table records for a given table
	function outputRecords($whatTable) {
		global $db;
		$sql = "SELECT * FROM $whatTable
						ORDER BY name, sequence";
		$result = $db->query($sql);
		if (!$result) die("List Error: " . $sql . "<br>" . $db->error);
		
		 // there is at least 1 result, so let's output it as a formatted table
		if ($result->num_rows > 0) {
			
			echo "<table>";
			echo "<tr>" . 
						"<td><b>Recipe</b></td>" . 
						"<td><b>#</b></td>" . 
						"<td><b>Text Content</b></td>" . 
						"<td></td>" . 
					 "</tr>";
			
			while( $row = $result->fetch_assoc() ) { // loop through the SQL results
				echo "<tr>" . 
							"<td>" . $row["name"] . "</td>" .
							"<td>" . $row["sequence"] . "</td>" . 
							"<td>" . $row["content"] . "</td>" .
							"<td><a onclick='window.location=\"records.php?dba=edit&rID=" . $row["id"] . "&rTable=" . $whatTable . "\"'>edit</a></td>" .
						 "</tr>";
			}
			echo "</table>";
			
		} else { // there are 0 results, so just return a zero
			return "No results.";
		}
	} // end function outputRecords

?>
	
	<h3>Table: <?= $table1; ?></h3>
	<?= outputRecords($table1); ?>
	
	<hr>
	<h3>Table: <?= $table2; ?></h3>
	<?= outputRecords($table2); ?>
	
	<hr>
	

</body>
</html>