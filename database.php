<?

// This file opens a MySQL connection to the database you created in cPanel

// define database values
$databaseServer = "138.68.243.154"; // IP number of database, may be on the same server
$databaseName = "kprycom1_kpry-477.com"; // database name
$databaseUser = "kprycom1_castawayadmin"; // database username
$databasePassword = "Shelly817!!";  // user password


/*
Available columns in each of the 3 tables:
- id: integer, auto-incremented unique identifier
- name: varchar, name of the recipe
- sequence: integer, step in the process
- content: varchar, contents of this text
- timestamp: timestamp, auto-updated value
*/

// attempt DB connection and die() if it fails
$db = new mysqli($databaseServer, $databaseUser, $databasePassword, $databaseName);
if ($db->connect_error) die("Database connection failed: " . $db->connect_error);

/*

Now you can set strings of SQL and submit them like this:

$sql = "SELECT * FROM $databaseTable"; 
$result = $db->query($sql);
if (!$result) die("Error: " . $sql . "<br>" . $db->error);

*/